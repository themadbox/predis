<?php

namespace Predis\Command;

/**
 * @link https://matt.sh/redis-geo
 * @author Roberto Galli <robbygallo@gmail.com>
 */
class GeoRadiusByMember extends PrefixableCommand
{
    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return 'georadiusbymember';
    }


    /**
     * {@inheritdoc}
     */
    protected function filterArguments(Array $arguments)
    {
        //var_dump(array_pop($arguments)); die;
        if (count($arguments) >= 2 && is_array($arguments[2])) {
            $options = $this->prepareOptions(array_pop($arguments));
            $arguments = array_merge($arguments, $options);
        }

        return $arguments;
    }

    /**
     * Returns a list of options and modifiers compatible with Redis.
     *
     * @param  array $options List of options.
     * @return array
     */
    protected function prepareOptions($options)
    {
        $options = array_change_key_case($options, CASE_UPPER);
        $normalized = array();

        //var_dump($options); die;

        if (!empty($options['DISTANCE'])) {
            $normalized[] = (int)$options['DISTANCE'];

			if (!empty($options['DISTANCE_UNIT_MISURE']) && in_array($options['DISTANCE_UNIT_MISURE'], array('m','km','mi')))
				$normalized[] = $options['DISTANCE_UNIT_MISURE'];
			else
				$normalized[] = 'km';
				
            if (!empty($options['WITHDISTANCE']) && $options['WITHDISTANCE'] === TRUE)
				$normalized[] = 'withdistance';

            if (!empty($options['GEOJSON']) && in_array($options['GEOJSON'],array('json','jsoncollection')))
				$normalized[] = sprintf('withgeo%s',$options['GEOJSON']);

            if (!empty($options['SORT']))
            {
				if($options['SORT'] == 'DESC')
					$normalized[] = 'descending';
				else
					$normalized[] = 'ascending';
			}
			else
				$normalized[] = 'ascending';
        }

        //var_dump($normalized); die;

        return $normalized;
    }

    /**
     * {@inheritdoc}
     */
    /*
    public function parseResponse($data)
    {
		return $data;
    }
    */
}
