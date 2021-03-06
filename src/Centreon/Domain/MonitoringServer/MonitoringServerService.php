<?php

/*
 * Copyright 2005 - 2019 Centreon (https://www.centreon.com/)
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * For more information : contact@centreon.com
 *
 */
declare(strict_types=1);

namespace Centreon\Domain\MonitoringServer;

use Centreon\Domain\MonitoringServer\Interfaces\MonitoringServerRepositoryInterface;
use Centreon\Domain\MonitoringServer\Interfaces\MonitoringServerServiceInterface;

/**
 * This class is designed to manage monitoring servers and their associated resources.
 *
 * @package Centreon\Domain\MonitoringServer
 */
class MonitoringServerService implements MonitoringServerServiceInterface
{
    /**
     * @var MonitoringServerRepositoryInterface
     */
    private $monitoringServerRepository;

    /**
     * PollerService constructor.
     * @param MonitoringServerRepositoryInterface $pollerRepository
     */
    public function __construct(MonitoringServerRepositoryInterface $pollerRepository)
    {
        $this->monitoringServerRepository = $pollerRepository;
    }

    /**
     * @inheritDoc
     */
    public function findServers(): array
    {
        try {
            return $this->monitoringServerRepository->findServers();
        } catch (\Exception $ex) {
            throw new MonitoringServerException('Error when searching for monitoring servers', 0, $ex);
        }
    }

    /**
     * @inheritDoc
     */
    public function findResource(int $monitoringServerId, string $resourceName): ?MonitoringServerResource
    {
        try {
            return $this->monitoringServerRepository->findResource($monitoringServerId, $resourceName);
        } catch (\Exception $ex) {
            throw new MonitoringServerException('Error when searching for a resource of monitoring server', 0, $ex);
        }
    }

    /**
     * @inheritDoc
     */
    public function findLocalServer(): ?MonitoringServer
    {
        try {
            return $this->monitoringServerRepository->findLocalServer();
        } catch (\Exception $ex) {
            throw new MonitoringServerException('Error when searching for the local monitoring servers', 0, $ex);
        }
    }
}
