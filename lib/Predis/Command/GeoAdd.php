<?php

namespace Predis\Command;

/**
 * @link https://matt.sh/redis-geo
 * @author Roberto Galli <robbygallo@gmail.com>
 */
class GeoAdd extends PrefixableCommand
{
    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return 'geoadd';
    }

    /**
     * {@inheritdoc}
     */
    protected function filterArguments(Array $arguments)
    {
        if (count($arguments) === 2 && is_array($arguments[1])) {
            $flattenedKVs = array($arguments[0]);
            $args = $arguments[1];

            foreach ($args as $k => $v)
				foreach($v as $val)
					$flattenedKVs[] = $val;

            return $flattenedKVs;
        }

        return $arguments;
    }
}
