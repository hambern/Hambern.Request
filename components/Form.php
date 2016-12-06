<?php namespace Hambern\Request\Components;

use Backend\Models\BrandSettings;
use Backend\Models\UserGroup;
use Cms\Classes\ComponentBase;
use Hambern\Request\Models\Request;
use Hambern\Request\Models\Settings;
use Hambern\Request\Models\Status;
use Lang;
use Mail;
use Validator;

class Form extends ComponentBase
{
    public function onRender()
    {
        $this->page['property'] = $this->getProperties();
    }

    public function onPost()
    {
        $request = new Request;
        $validator = Validator::make($post = post(), $request->rules);
        if ($validator->fails()) {
            $errors = $validator->messages()->all();
            return ['#form_message' => $this->renderPartial('@errors', compact('errors'))];
        }
        $request->fill($post);
        if ($status = Status::first()) {
            $request->status_id = Settings::get('default_status') ?: $status->id;
        }
        $request->save(null, $post['_session_key']);

        if (Settings::get('send_mail')) {
            $this->sendNoticeMail();
        }
        return ['#request_form' => $this->renderPartial('@thanks')];
    }

    public function sendNoticeMail()
    {
        if (!empty($ids = Settings::get('receive_groups'))) {
            foreach (UserGroup::find($ids) as $group) {
                foreach ($group->users as $user) {
                    $post = post();
                    Mail::send('hambern.request::mail.notice', $post, function ($message) use ($post, $user) {
                        $message->replyTo($post['email'], !empty($post['name']) ? $post['name'] : null);
                        $message->to($user->email);
                    });
                }
            }
        }
    }

    public function componentDetails()
    {
        return [
            'name'        => 'hambern.request::lang.form.name',
            'description' => 'hambern.request::lang.form.description'
        ];
    }

    public function defineProperties()
    {
        return [
            'name' => [
                'title'             => 'hambern.request::lang.labels.name',
                'description'       => 'Let the guest enter a name',
                'type'              => 'checkbox',
                'default'           => true,
            ],
            'phone' => [
                'title'             => 'hambern.request::lang.labels.phone',
                'description'       => 'Let the guest enter a phone number',
                'type'              => 'checkbox',
                'default'           => false,
            ],
            'subject' => [
                'title'             => 'hambern.request::lang.labels.subject',
                'description'       => 'Let the guest enter a subject',
                'type'              => 'checkbox',
                'default'           => true,
            ],
        ];
    }
}
