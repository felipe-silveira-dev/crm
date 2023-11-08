<div>
    @isset($this->user)
        {{ $this->user->name }}
        <br>
        {{ $this->user->email }}
        <br>
        {{ $this->user->created_at->format('d/m/Y H:i') }}
        <br>
        {{ $this->user->updated_at->format('d/m/Y H:i') }}
        <br>
        {{ $this->user->deleted_at?->format('d/m/Y H:i') }}
        <br>
        {{ $this->user->deletedBy?->name }}
    @endisset
</div>
