<?php


namespace Islami\Shared\Infrastructure\Application\Command\Middleware;


use Islami\Shared\Bus\Event\DomainEventPublisher;
use Islami\Shared\Bus\Event\EventStoreRepository;
use Islami\Shared\Infrastructure\Persistence\TransactionManager;

class CommandBusMiddleware
{

    /**
     * @var TransactionManager
     */
    private $transactionManager;
    /**
     * @var EventStoreRepository
     */
    private $eventStore;

    public function __construct(
        TransactionManager $transactionManager,
        EventStoreRepository $eventStore)
    {
        $this->transactionManager = $transactionManager;
        $this->eventStore = $eventStore;
    }

    public function handle($command, $next)
    {
        if ($command->useTransaction())
            return $this->handleWithTransaction($command, $next);
        else
            return $this->handleWithoutTransaction($command, $next);
    }

    protected function handleWithTransaction($command, $next)
    {
        try {
            $this->transactionManager->begin();
            $return = $next($command);
            $this->recordEventsToEventStore();
            $this->transactionManager->commit();
        } catch (\Exception $e) {
            $this->transactionManager->rollBack();
            throw $e;
        }
        return $return;
    }

    protected function handleWithoutTransaction($command, $next)
    {
        $result = $next($command);
        $this->recordEventsToEventStore();
        return $result;
    }

    private function recordEventsToEventStore()
    {
        $domain_events = DomainEventPublisher::instance()->pullDomainEvents();
        foreach ($domain_events as $domain_event) {
            $this->eventStore->persist($domain_event);
        }
    }

}
