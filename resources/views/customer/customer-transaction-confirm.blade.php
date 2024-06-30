<x-customer-layout>
    <div>
        @if($transactionList == 'transactionList')
            <livewire:customer-site.transaction-confirm :hash="$hash" :transaction-list="$transaction" />
        @else
            <livewire:customer-site.transaction-confirm :hash="$hash" :transaction="$transaction" />
        @endif
    </div>
</x-customer-layout>
