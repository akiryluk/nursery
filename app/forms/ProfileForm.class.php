<?php

//Add ProfileForm class to edit own profile of each user.

class ProfileForm extends Form
{
    public function build()
    {
        $this->addFormField('lastName');
        $this->addFormField('firstName');
        $this->addFormField('address');
        $this->addFormField('city');
        $this->addFormField('zipCode');
        $this->addFormField('phone');
        $this->addFormField('email');
    }
}