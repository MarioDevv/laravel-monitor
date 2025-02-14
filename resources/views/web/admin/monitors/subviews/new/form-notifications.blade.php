<div class="relative my-6 flex w-full flex-col rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
    <label class="block text-sm text-slate-800"><b>How will we notify you?</b></label>

    <div class="mt-5 flex justify-around">
        <div class="flex flex-col">
            <x-admin::checkbox text="Email" id="email" name="notify_email" :checked="true" />
            <p class="text-sm text-slate-500">mario@atsys.es</p>
        </div>
        <div class="flex flex-col">
            <x-admin::checkbox text="SMS Message" id="sms" name="notify_sms" :checked="false" />
            <p class="text-sm text-slate-800 underline cursor-pointer">Add phone number</p>
        </div>
        <div class="flex flex-col">
            <x-admin::checkbox text="Voice call" id="call" name="notify_call" :checked="false" />
            <p class="text-sm text-slate-800 underline cursor-pointer">Add phone number</p>
        </div>
        <div class="flex flex-col">
            <x-admin::checkbox text="Mobile push" id="push" name="notify_push" :checked="false" />
            <p class="text-sm text-slate-800">Working on it...</p>
        </div>
    </div>

    <p class="mt-8 text-sm text-slate-800">
        You can set these variables in your <span class="underline">user profile</span>
    </p>
</div>
