<?php
/**
 * @author : Ugurkan Kaya
 * @date   : 29.12.2017
 */

namespace Container;

use Container\Exceptions\ServiceExistsException;
use Container\Exceptions\ServiceNotFoundException;
use Container\Exceptions\ServiceResolverException;
use ReflectionClass;

class Container extends ContainerAbstract implements ContainerInterface
{
    /**
     * {@inheritdoc}
     */
    public function registerServices(array $services)
    {
        if (count($services) === 0) {
            throw new ServiceNotFoundException("No services for registering found.");
        }

        foreach ($services as $serviceKey => $serviceValue) {
            if ($this->hasService($serviceKey)) {
                throw new ServiceExistsException("Unable to register a existing service : " . $serviceKey);
            }

            $this->addService($serviceKey, $serviceValue["serviceResolver"], $serviceValue["serviceParameters"] ?? []);
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function registerClosureServices(callable $services)
    {
        return $this->registerServices($services());
    }

    /**
     * Resolve the container service.
     * @param $serviceName
     * @return object
     * @throws ServiceResolverException
     */
    public function resolveService($serviceName)
    {
        $getService = $this->getService($serviceName);

        foreach ($getService["serviceParameters"] as $key => $value) {
            if ($this->hasService($value)) {
                $getService["serviceParameters"][$key] = $this->resolveService($value);
            }
        }

        $resolveService = (new ReflectionClass($getService["serviceResolver"]))
            ->newInstanceArgs($getService["serviceParameters"]);

        if (!$resolveService) {
            throw new ServiceResolverException("Failed to resolve service : " . $serviceName);
        }

        return $resolveService;
    }
}