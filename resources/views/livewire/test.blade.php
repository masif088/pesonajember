<div>
    <h1>{{ $count }}</h1>

    <button wire:click="increment">+</button>

    <button wire:click="decrement">-</button>

    <select wire:change="change(event.target.value)">
        <option value="1">aa</option>
        <option value="2">asd</option>
    </select>
</div>
