<?php
declare(strict_types=1);

namespace msales\RethinkTest\Queues;

use DateTime;
use msales\Flyweight\Contracts\Event\EventType;
use msales\Flyweight\Event\Event;
use msales\Flyweight\Event\Worker\EventWorker;
use msales\RethinkTest\RethinkDB\RethinkDB;
use r\ValuedQuery\RVar;
use r;

class Worker extends EventWorker
{
    /** @var RethinkDB */
    private $rethinkDb;

    /**
     * @param int      $workerId
     * @param int|null $processId
     */
    public function __construct($workerId, $processId)
    {
        parent::__construct($workerId, $processId, EventType::VISIT(), [], 1000);

        $this->rethinkDb = $this->connectToRethinkDB();
    }

    /**
     * @param Event $event
     */
    protected function consume($event)
    {
        $this->queue($event);
    }

    /**
     * @param Event[] $events
     *
     * @return bool
     */
    protected function flush(array $events)
    {
        $offerStats = [];

        foreach ($events as $event) {
            $offerStats[] = ['offer_id' => 1, 'time' => new DateTime('@' . $event->timestamp)];
        }

        $this->rethinkDb
            ->db('test')
            ->table('visits')

            //->update(function(RVar $visit) {
            //    r\branch($visit->eq(null))
            //    return null;
            //})
            ->insert($offerStats)
            ->run($this->rethinkDb->getConnection())
            ;

        return true;
    }

    /**
     * @return RethinkDB
     */
    private function connectToRethinkDB(): RethinkDB
    {
        $r = new RethinkDB();
        $r->connect('localhost');

        return $r;
    }
}
