<form method="post" action="handler.php" class="personal">
    <input type="hidden" name="form-name" value="profile">
    <div class="personal__greeting">
        <p>You've successfully joined the game.</p>
        <p>Tell us more about yourself.</p>
    </div>
    <div class="personal__username">
        <label for="name">Who are you?</label>
        <p class="username-tip">Alpha-numeric user name</p>
        <input type="text" id="name" name="username" placeholder="arya">
    </div>
    <div class="personal__house">
        <label for="house">Your Great House</label>
        <select name="house" id="house">
            <option value="none" class="form__option">Select House</option>
            <option value="Stark" class="form__option">Stark</option>
            <option value="Arryn" class="form__option">Arryn</option>
            <option value="Baratheon" class="form__option">Baratheon</option>
            <option value="Tully" class="form__option">Tully</option>
            <option value="Greyjoy" class="form__option">Greyjoy</option>
            <option value="Lannister" class="form__option">Lannister</option>
            <option value="Tyrell" class="form__option">Tyrell</option>
            <option value="Martell" class="form__option">Martell</option>
            <option value="Targaryen" class="form__option">Targaryen</option>
        </select>
    </div>
    <div class="personal__preferences">
        <label for="pref">Your preferences, hobbies, wishes, etc.</label>
        <textarea id="pref" name="preferences" rows="5" cols="80" placeholder="I have a long TOKILL list..."></textarea>
    </div>
    <input class="button" type="submit" id="save" value="Save">
</form>