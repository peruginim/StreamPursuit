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
