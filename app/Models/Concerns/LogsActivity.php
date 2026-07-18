<?php

namespace App\Models\Concerns;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

trait LogsActivity
{
    protected static function bootLogsActivity(): void
    {
        static::created(fn ($model) => $model->recordActivity('created'));
        static::updated(fn ($model) => $model->recordActivity('updated'));
        static::deleted(fn ($model) => $model->recordActivity('deleted'));
    }

    protected function recordActivity(string $action): void
    {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'subject_type' => static::class,
            'subject_id' => $this->getKey(),
            'description' => class_basename($this)." '{$this->activityLogLabel()}' {$action}",
        ]);
    }

    public function activityLogLabel(): string
    {
        foreach (['name', 'product_name', 'category_name', 'fullname', 'email'] as $attribute) {
            if (! empty($this->{$attribute})) {
                return $this->{$attribute};
            }
        }

        return (string) $this->getKey();
    }
}
