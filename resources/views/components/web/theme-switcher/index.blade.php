<div
    x-data="{
        theme: null,

        init: function () {
            this.theme = localStorage.getItem('theme') || 'system'

            $dispatch('theme-changed', this.theme)

            $watch('theme', (theme) => {
                $dispatch('theme-changed', theme)
            })
        }
    }"
    class="grid grid-flow-col gap-x-1"
>
    <x-web.theme-switcher.button
        icon="heroicon-m-sun"
        theme="light"
    />

    <x-web.theme-switcher.button
        icon="heroicon-m-moon"
        theme="dark"
    />

    <x-web.theme-switcher.button
        icon="heroicon-m-computer-desktop"
        theme="system"
    />
</div>
