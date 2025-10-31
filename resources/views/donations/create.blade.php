<strong>Derma</strong>
<form method="POST" action="{{ route('donation.store') }}">
    @csrf
    <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
    </div>
    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div>
    <label for="phone">Phone Number:</label>
    <input type="text" id="phone" name="phone" required>
</div>
    <div>
        <label for="amount">Amount:</label>
        <input type="number" id="amount" name="amount" required>
    <button type="submit">Hantar Derma</button>