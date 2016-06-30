<?php

namespace tests\codeception\backend\_pages;

use yii\codeception\BasePage;
use app\models\backend\LoginForm;

/**
 * Represents login page
 * @property \tests\codeception\backend\AcceptanceTester|\tests\codeception\backend\FunctionalTester|\tests\codeception\backend\AcceptanceTester|\tests\codeception\backend\FunctionalTester $actor
 */
class LoginPage extends BasePage
{
    public $route = 'site/login';

    /**
     * @param string $username
     * @param string $password
     */
    public function login($username, $password)
    {
        $loginForm = new LoginForm();

        $this->actor->fillField('input[name="' . $loginForm->formName() . '[username]"]', $username);
        $this->actor->fillField('input[name="' . $loginForm->formName() . '[password]"]', $password);
        $this->actor->click('login-button');
    }
}
