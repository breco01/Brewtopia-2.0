<div class="bg-white dark:bg-brew-beige rounded-xl p-8 shadow-sm">
                <h3 class="text-2xl font-extrabold mb-6">Overzicht</h3>

    <div class="space-y-4">
        <div class="flex justify-between items-center">
            <span class="text-brew-text font-medium">Lid sinds</span>
            <span class="font-semibold">{{ Auth::user()->created_at->format('d/m/Y') }}</span>
        </div>
        <div class="flex justify-between items-center">
            <span class="text-brew-text font-medium">Bieren beoordeeld</span>
            <span class="font-semibold">12</span>
        </div>
        <div class="flex justify-between items-center">
            <span class="text-brew-text font-medium">Artikels gelezen</span>
            <span class="font-semibold">3</span>
        </div>
        <div class="flex justify-between items-center">
            <span class="text-brew-text font-medium">Laatste login</span>
            <span class="font-semibold">
                {{ Auth::user()->last_login_at ? Auth::user()->last_login_at->format('d/m/Y H:i') : 'Onbekend' }}
            </span>
        </div>
    </div>
</div>
