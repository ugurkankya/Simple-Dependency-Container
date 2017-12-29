<?php
/**
 * @author : Ugurkan Kaya
 * @date   : 29.12.2017
 */

namespace Container;

interface ContainerInterface
{
    /**
     * Register the container services.
     * @param array $services
     * @return bool
     * @throws |ServiceExistsException
     * @throws |ServiceNotFoundException
     */
    public function registerServices(array $services);

    /**
     * Register the container closure services.
     * @param callable $services
     * @return bool
     */
    public function registerClosureServices(callable $services);
}