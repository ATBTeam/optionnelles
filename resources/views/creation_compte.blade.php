<!DOCTYPE html>
<html>
    <head>
        <title>Création du compte</title>

        <style>

        </style>
    </head>
    <body>
        <form action="{{ action('RemindersController@postRemind') }}" method="POST">
            <input type="email" name="email">
            <input type="submit" value="Send Reminder">
        </form>
    </body>
</html>