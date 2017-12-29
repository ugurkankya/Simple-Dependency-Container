<?php
/**
 * @author : Ugurkan Kaya
 * @date   : 29.12.2017
 */

namespace Container;

use Container\Exceptions\ServiceExistsException;
use Container\Exceptions\ServiceNotClosureException;
use Container\Exceptions\ServiceNotFoundException;

abstract class ContainerAbstract
{
    /**
     * @var $services
     */
    protected $services = [];

    /**
     * Check if the service does exists.
     * @param $serviceName
     * @return bool
     */
    public function hasService($serviceName): bool
    {
        return isset($this->services[$serviceName]) && array_key_exists($serviceName, $this->services) === true;
    }

    /**
     * Add a new container service.
     * @param $serviceName
     * @param $serviceResolver
     * @param array $serviceParameters
     * @return bool|null
     * @throws ServiceExistsException
     */
    public function addService($serviceName, $serviceResolver, array $serviceParameters = []): ?bool
    {
        if ($this->hasService($serviceName)) {
            throw new ServiceExistsException("Unable to add same service as : " . $serviceName);
        }

        $this->services[$serviceName] = [
            "serviceResolver"   => $serviceResolver,
            "serviceParameters" => $serviceParameters
        ];

        return true;
    }

    /**
     * Add the closure service.
     * @param callable $serviceClosure
     * @return mixed
     * @throws ServiceNotClosureException
     */
    public function addClosureService(callable $serviceClosure)
    {
        if($serviceClosure instanceof \Closure === false) {
            throw new ServiceNotClosureException("Service is not a closure, please use addService() instead.");
        }

        return $serviceClosure($this);
    }

    /**
     * Get the container service.
     * @param $serviceName
     * @return array|null
     * @throws ServiceNotFoundException
     */
    public function getService($serviceName): ?array
    {
        if (!$this->hasService($serviceName)) {
            throw new ServiceNotFoundException("Unable to find the service : " . $serviceName);
        }

        return $this->services[$serviceName];
    }

    /**
     * Remove the container service.
     * @param $serviceName
     * @return bool|null
     * @throws ServiceNotFoundException
     */
    public function forgetService($serviceName): ?bool
    {
        if (!$this->hasService($serviceName)) {
            throw new ServiceNotFoundException("Unable to remove a non existing service : " . $serviceName);
        }

        unset($this->services[$serviceName]);

        return true;
    }

    /**
     * Get all container services.
     * @return array
     */
    public function getServices(): array
    {
        return $this->services;
    }

    /**
     * Resolve the container service.
     * @param $serviceName
     * @return mixed
     */
    abstract public function resolveService($serviceName);
}