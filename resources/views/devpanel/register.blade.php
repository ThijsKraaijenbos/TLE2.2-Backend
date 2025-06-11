<div>
    <h1>Maak Developer Account</h1>
    <form method="POST" action="api/dev-user">
        @csrf
        <div>
        <label for="email">Email</label>
        <input name="email">
        </div>
        <div>
        <label for="password">Wachtwoord</label>
        <input name="password">
        </div>
        <input type="submit" value="Maak Account">
    </form>

    <h1>API Key wordt hieronder weergeven wanneer er een account wordt gemaakt</h1>
    <h2>Sla deze API Key ergens goed op, je kunt hem niet opnieuw bekijken!</h2>
    <input type="text" readonly name="outputToken">
    @if (isset($res))
        <h1>Response</h1>
        @endif
</div>
