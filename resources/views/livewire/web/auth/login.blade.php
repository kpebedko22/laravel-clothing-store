<form wire:submit="login">
    <div class="mb-4 flex flex-col gap-3">

        <div class="">
            <x-web.form.label for="email" label="{{ 'Email' }}"/>
            <x-web.form.input name="email"
                              placeholder="{{ 'Введите email' }}"
                              wire:model="email"
            />
            <x-web.form.error for="email"/>
        </div>

        <div>
            <x-web.form.label for="password" label="{{ 'Пароль' }}"/>
            <x-web.form.input type="password"
                              name="password"
                              placeholder="{{ 'Введите пароль' }}"
                              wire:model="password"
            />
            <x-web.form.error for="password"/>
        </div>

        <div class="flex justify-between">
            <div class="flex items-center">
                <input id="remember"
                       name="remember"
                       type="checkbox"
                       wire:model="remember"
                       class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                >
                <label for="remember"
                       class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                >{{ 'Запомнить' }}</label>
            </div>

            <div class="">
                <a href=""
                   class="text-primary hover:text-primary-h transition-all outline-none focus-visible:text-primary-h">
                    {{ 'Забыли пароль?' }}
                </a>
            </div>
        </div>


    </div>
    <div class="flex">
        <button type="submit"
                class="py-3 px-6 text-white bg-primary border-primary transition-all outline-none rounded-lg hover:border-primary-h hover:bg-primary-h focus-visible:border-primary-h focus-visible:bg-primary-h">
            {{ 'Войти' }}
        </button>
    </div>
</form>
