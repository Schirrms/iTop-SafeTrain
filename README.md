# iTop-SafeTrain

An iTop Extension to affect CIs to SAFe Trains. Trains are defined as Tag.

This permit to affect the same FunctionalCI to several Trains.

Adds also a 'Train' class for iTop. This is essentially a placeholder for customized dashboards

## Ideas

We recently split our DSI into SAFE Trains. But our SI CIs are highly shared amongst teams, and saying that one CI was dedicated to one train is not always possible.

So we started to use a specific tag, and we allowed the same CI to be 'shared' between Trains.

But now, we need to create report dedicated for our Trains. Hence the ideas of a 'Train' Class, with the same information as the Train TAG, but with specific Dashboards.

## Current state

As of November 2023, this extension is a fusion between the former version of iTop-SafeTrain and another work, iTop-SafeTrainClass

## The new 's_train_count' feeding

The 0.3.0 release of SafeTrain adds a new field named 's_train_count'. This field contains the number of trains each CIs belongs.

Unfortunately, I know no ways of updating this field from inside iTop.

Instead, I use a SQL query to update this field :

~~~sql
UPDATE functionalci SET `s_train_count`= LENGTH(LTRIM(RTRIM(`s_train`))) - LENGTH(REPLACE(LTRIM(RTRIM(`s_train`)), ' ', '')) + 1 WHERE LTRIM(RTRIM(`s_train`)) != '';
~~~

This SQL query is only to execute on an iTop instance who had previously s_train fields added. Obviously, every new changes of trains in iTop update this field.

## Team(s) of the train

I was asked to be able to affect more specifically a 'sub team' within the train to a device. And this is the point when you start to think that using tags was not such a creative idea…

But as the usage of the Train field in iTop is not only used in iTop, but also in some integrations, changing the train attribute from a Tag to, let's say an enumerate would have been a challenge.

So I choose to add another tag field, train_team, and I will implement some php logic to control this field (hopefully 🙂)

This is where the 0.4.x branch starts.

## Adding a snippet

While not really related to the SAFe method, we use the iTop webhook integration to update some Custom Attributes whenever a VM has some changes, like a train change.

I wad only able to do that trough a small snippet, ans this snippet is added in this extension.
