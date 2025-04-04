<?php

namespace Volk\SecureImg;

use XF\AddOn\AbstractSetup;
use XF\AddOn\StepRunnerInstallTrait;
use XF\AddOn\StepRunnerUninstallTrait;
use XF\AddOn\StepRunnerUpgradeTrait;
use XF\Db\Schema\Create;

class Setup extends AbstractSetup
{
    use StepRunnerInstallTrait;
    use StepRunnerUpgradeTrait;
    use StepRunnerUninstallTrait;

    // ################################## INSTALL ###########################################

    public function installStep1()
    {
    }

    public function installStep2()
    {
    }


    // ################################## UNINSTALL ###########################################

    public function uninstallStep1()
    {
    }
}