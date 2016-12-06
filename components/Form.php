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
    public function onPost()
    {
        $request = new Request;
        $validator = Validator::make($post = post(), $request->rules);
        if ($validator->fails()) {
            $errors = $validator->messages()->all();
            return ['#form_message' => $this->renderPartial('@_errors', compact('errors'))];
        }
        unset($post['homepage']);
        $request->fill($post);
        if ($status = Status::first()) {
            $request->status_id = Settings::get('default_status') ?: $status->id;
        }
        $request->save(null, $post['_session_key']);

        if (Settings::get('send_mail')) {
            $this->sendNoticeMail();
        }
        return ['#request_form' => $this->renderPartial('@_thanks')];
    }

    public function sendNoticeMail()
    {
        $post = post();
        if (!empty($ids = Settings::get('receive_groups'))) {
            foreach (UserGroup::find($ids) as $group) {
                foreach ($group->users as $user) {
                    Mail::send('hambern.request::mail.notice', $post, function ($message) use ($post, $user) {
                        $message->replyTo($post['email'], $post['name']);
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
        return [];
    }
}
