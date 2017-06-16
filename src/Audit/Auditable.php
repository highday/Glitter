<?php

namespace Glitter\Audit;

trait Auditable
{
    public function audit_logs()
    {
        return $this->hasMany(Log::class)->latest();
    }

    public function log(string $action, array $data = [])
    {
        $log = new Log([
            'action_at' => \Carbon\Carbon::now(),
            'action'    => $action,
            'data'      => $data,
        ]);

        if ($this->activeStore) {
            $log->store()->associate($this->activeStore);
        }

        $this->audit_logs()->save($log);
    }
}
