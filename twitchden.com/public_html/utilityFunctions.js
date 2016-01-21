function getRandom()
{
  return Math.random();
}

function getRandomArbitrary(min, max)
{
  return Math.random() * (max - min) + min;
}

function getRandomInt(min, max)
{
  return Math.floor(Math.random() * (max - min)) + min;
}

function getRandomIntInclusive(min, max)
{
  return Math.floor(Math.random() * (max - min + 1)) + min;
}

function sanitizeGame(game)
{
    var newString = "";
    for(var i = 0; i < game.length; i++)
    {
        if(game[i].localeCompare(" ") == 0)
            newString += "%20";
        else
            newString += game[i];
    }
    return newString;
}

function followAPI(channel)
{
    var success = function()
    {
        // Change color of button to green and change 'Follow' to 'Followed'
        document.getElementById("follow-button").innerHTML = "Followed";
        document.getElementById("follow-button").className = "btn btn-success btn-lg btn-block";
        document.getElementById("follow-button").removeAttribute("onclick");
    }
    var failure = function(step)
    {
        // Popup saying 'Something broke, make sure you're logged into twitch.'
        //var token = Twitch.getToken();
        window.alert("Something went wrong at step: " + step);
    }

    Twitch.getStatus(function(error, status)
    {
        if(error) return failure("1");
        if(!status.authenticated) return failure("-1");

        Twitch.api({method: 'user'}, function(error, user)
        {
            if(error) return failure("2");
            var xmlHttp = new XMLHttpRequest();
            var url = "https://api.twitch.tv/kraken/users/" + user.name + "/follows/channels/"
            + channel + "?oauth_token=[" + Twitch.getToken() + "]";
            xmlHttp.open('PUT', url, true);
            xmlHttp.onreadystatechange = function()
            {
                //if (xmlHttp.readyState === 4 && xmlHttp.status === 200)
                if(xmlHttp.readyState === 4)
                {
                    var check = xmlHttp.status;
                    alert(check);
                    if(check.toString()==="200")
                    {
                        success();
                    }
                    //success();
                }
                else
                {
                    failure("3");
                }
            };
            xmlHttp.setRequestHeader("Content-Type", "application/json");
            xmlHttp.setRequestHeader("Accept", "application/vnd.twitchtv.v3+json");
            //xmlHttp.setRequestHeader("Authorization", "OAuth " + Twitch.getToken());
            xmlHttp.setRequestHeader("Content-Length", "0");
            xmlHttp.send();
        });
    });
}

function follow(channel)
{
    var success = function()
    {
        // Change color of button to green and change 'Follow' to 'Followed'
        document.getElementById("follow-button").innerHTML = "<i class=\"fa fa-heart\"></i> Followed";
        document.getElementById("follow-button").className = "btn btn-success btn-lg btn-block";
        document.getElementById("follow-button").removeAttribute("onclick");
        //document.getElementById("follow-button").onclick = unFollow(channel);
    }
    var failure = function(step)
    {
        // Popup saying 'Something broke, make sure you're logged into twitch.'
        var token = Twitch.getToken();
        window.alert("Something went wrong at step: " + token);
    }

    Twitch.getStatus(function(error, status)
    {
        if(error) return failure("1");
        if(!status.authenticated) return failure("-1");

        Twitch.api({method: 'user'}, function(error, user)
        {
            if(error) return failure("2");

            Twitch.api({verb: 'PUT', method: 'users/' + user.name + '/follows/channels/' + channel}, function(error, response)
            {
                if(error) return failure(user.name);
                success();
            });
        });
    });
}

function unFollow(channel)
{
    var success = function()
    {
        // Change color of button to green and change 'Follow' to 'Followed'
        document.getElementById("follow-button").innerHTML = "<i class=\"fa fa-heart\"></i> Follow";
        document.getElementById("follow-button").className = "btn btn-primary btn-lg btn-block";
        document.getElementById("follow-button").removeAttribute("onclick");
        //document.getElementById("follow-button").onclick = follow(channel);
    }
    var failure = function(step)
    {
        // Popup saying 'Something broke, make sure you're logged into twitch.'
        var token = Twitch.getToken();
        window.alert("Something went wrong at step: " + token);
    }

    Twitch.getStatus(function(error, status)
    {
        if(error) return failure("1");
        if(!status.authenticated) return failure("-1");

        Twitch.api({method: 'user'}, function(error, user)
        {
            if(error) return failure("2");

            Twitch.api({verb: 'DELETE', method: 'users/' + user.name + '/follows/channels/' + channel}, function(error, response)
            {
                if(error) return failure(user.name);
                success();
            });
        });
    });
}
