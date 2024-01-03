<div x-data="{
        tab: 'register',
        showErrors: false,
        selectTab(tab) {
            this.showErrors = this.tab === tab;
            this.tab = tab;
        },
        submit() {
            this.tab === 'login'
                ? $wire.existedAccount()
                : $wire.newAccount();

            this.showErrors = true;
        }
    }"
     class="mt-4"
>
    <div class="grid grid-cols-2">
        <div class="flex justify-center cursor-pointer hover:text-primary py-2 transition-all"
             :class="{'text-primary border-b border-primary': tab === 'register'}"
             @click="selectTab('register')"
        >{{ 'Создание аккаунта' }}
        </div>

        <div class="flex justify-center cursor-pointer hover:text-primary py-2 transition-all"
             :class="{'text-primary border-b border-primary': tab === 'login'}"
             @click="selectTab('login')"
        >{{ 'Вход в аккаунт' }}
        </div>
    </div>

    <div class="mt-4 flex flex-col gap-3">
        <div class="">
            <x-web.form.label for="email" label="{{ 'Email' }}"/>
            <x-web.form.input name="email"
                              placeholder="{{ 'Введите email' }}"
                              wire:model="email"
            />
            <div x-show="showErrors">
                <x-web.form.error for="email"/>
            </div>
        </div>

        <div class=""
             x-show="tab === 'login'"
        >
            <x-web.form.label for="password" label="{{ 'Пароль' }}"/>
            <x-web.form.input name="password"
                              type="password"
                              placeholder="{{ 'Введите пароль' }}"
                              wire:model="password"
            />
            <div x-show="showErrors">
                <x-web.form.error for="password"/>
            </div>
        </div>

        <button type="submit"
                class="py-3 px-6 text-white bg-primary border-primary transition-all outline-none rounded-lg hover:border-primary-h hover:bg-primary-h focus-visible:border-primary-h focus-visible:bg-primary-h"
                x-text="tab === 'login' ? 'Войти' : 'Зарегистрироваться'"
                @click="submit()"
        ></button>
    </div>
</div>

