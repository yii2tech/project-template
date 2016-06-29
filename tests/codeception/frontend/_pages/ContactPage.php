<?php

namespace tests\codeception\frontend\_pages;

use yii\codeception\BasePage;
use app\models\frontend\ContactForm;

/**
 * Represents contact page
 * @property \tests\codeception\frontend\AcceptanceTester|\tests\codeception\frontend\FunctionalTester $actor
 */
class ContactPage extends BasePage
{
    public $route = 'help/contact';

    /**
     * @param array $contactData
     */
    public function submit(array $contactData)
    {
        $contactForm = new ContactForm();
 
        foreach ($contactData as $field => $value) {
            $inputType = $field === 'body' ? 'textarea' : 'input';
            $this->actor->fillField($inputType . '[name="' . $contactForm->formName() . '[' . $field . ']"]', $value);
        }
        $this->actor->click('contact-button');
    }
}
