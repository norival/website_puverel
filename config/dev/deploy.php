<?php

use EasyCorp\Bundle\EasyDeployBundle\Deployer\DefaultDeployer;

return new class extends DefaultDeployer
{
    public function configure()
    {
        return $this->getConfigBuilder()
            // SSH connection string to connect to the remote server (format: user@host-or-IP:port-number)
            ->server('norival')
            // the absolute path of the remote server directory where the project is deployed
            ->deployDir('/home/laxa7358/dev/puverel/')
            // the URL of the Git repository where the project code is hosted
            ->repositoryUrl('git@github.com:norival/website_puverel.git')
            // the repository branch to deploy
            ->repositoryBranch('dev')
            ->remoteComposerBinaryPath('/opt/cpanel/composer/bin/composer')
            ->sharedFilesAndDirs(['.env'])
            ->symfonyEnvironment('dev')
        ;
    }
    public function beforePreparing() {
        $this->runRemote('cp {{ deploy_dir }}/repo/.env {{ project_dir }}/.env');
        /* $this->runRemote('cp {{ deploy_dir }}/repo/.env.development {{ project_dir }}/.env.development'); */
    }

    // run some local or remote commands before the deployment is started
    public function beforeStartingDeploy()
    {
        /* $this->runLocal('yarn encore prod'); */
        // $this->runLocal('./vendor/bin/simple-phpunit');
    }

    // run some local or remote commands after the deployment is finished
    public function beforeFinishingDeploy()
    {
        /* $this->runRemote('/opt/cpanel/composer/bin/composer update --no-dev --optimize-autoloader'); */
        // $this->runRemote('{{ console_bin }} app:my-task-name');
        // $this->runLocal('say "The deployment has finished."');
    }
};
