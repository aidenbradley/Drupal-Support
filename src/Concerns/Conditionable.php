<?php

namespace Drupal\drupal_support\Concerns;

/** Taken from the illuminate/support package as it's a nice trait */
trait Conditionable
{
    /**
     * Apply the callback if the given "value" is truthy.
     *
     * @return $this|mixed
     */
    public function when($value, callable $callback, ?callable $default = null)
    {
        if ($value) {
            return $callback($this, $value) ?: $this;
        } elseif ($default) {
            return $default($this, $value) ?: $this;
        }

        return $this;
    }

    /**
     * Apply the callback if the given "value" is falsy.
     *
     * @param  mixed  $value
     * @return $this|mixed
     */
    public function unless($value, callable $callback, ?callable $default = null)
    {
        if (! $value) {
            return $callback($this, $value) ?: $this;
        } elseif ($default) {
            return $default($this, $value) ?: $this;
        }

        return $this;
    }
}
