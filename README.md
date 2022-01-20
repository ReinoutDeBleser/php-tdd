# Test Driven Development

- Repository: `php-tdd`
- Type of Challenge: `Learning challenge`
- Duration: `3 days`
- Team challenge : `solo`

## Learning objectives
- Ability to write and read unit tests
- Understanding the importance of Test Driven Development

## The Mission
In the following scenario we are going to explore "Unit Tests" and Test Driven Development, feel free to ask your coach more information about this.
Start with watching this [great YouTube introduction](https://www.youtube.com/watch?v=WMqe0jkqPMQ) to the subject.

We are going to create a simple booking software for meeting rooms.
You can write this in Symfony

REWRITTEN: 
### What are unit tests? In my own words
Unit testing is testing code pieces in isolation with other code that tests it. 
Replaces manual testing in the browser by creating code that does so for you. 

Immediate advantages:

- Automated and repeatable testing of how the code runs. 
- Tests are way more specific, and it's easier and more accurate than point-and-click testing via a GUI.
- Basically, once you write a test to prevent a specific bug, it will prevent that bug from ever happening again long term stability is boosted massively like this. 

### What is Test Driven Development? Occam's razor of coding
If you write the tests before the working code that should run the program or app we call this Test-Driven Development (TDD for short).

Additional advantages TDD:

- no speculative code writing -- just enough to make the tests pass
- using TDD code is always covered by tests
- You're forced into thinking about the code before starting which usually improves the design of the code in the long run.

### What is PHPUnit?
[PHPUnit](https://phpunit.de/) is the PHP version of the [xUnit architecture](https://en.wikipedia.org/wiki/XUnit) for unit testing frameworks. 
This means that many other languages have their own version of this unit testing framework. 
This means you will be able to write tests in many languages after learning about PHPUnit!

### Installation
#### Using Symfony  CHECK TESTING DOCS @ [link](https://symfony.com/doc/current/testing.html)
Rename the `phpunit.xml.dist` on the root to `phpunit.xml`.

Always place your tests in the `tests/` directory.
Now run `php ./vendor/bin/phpunit`, this will run all valid tests in your tests' directory.
***The first time you run this script this will also install PHPUnit for you!***

## Must-have features 
Create the following entities
- User
    - password, email (if working with the login)
    - username OR email field (you can choose)
    - credit (integer, start credit 100)
    - premiumMember (bool, default false)
- Room
    - name
    - onlyForPremiumMembers (bool, default false)
- Bookings
    - Relation to room & User
    - Start date (datetime)
    - End date (datetime)

### General flow    how to split everything up 
For now just create rooms directly in the db, you do not need to provide an interface for this. ✔

Steps:


// On the homepage the user gets to see all the rooms, with a link to book a room. 
1. create a homepage -> using rooms -> root  ✔
2. get some data from database using Doctrine 
3. get specific data from database and display in on /. 
4. get array of data from database and display all of them on /
5. add a link to separate pages -> use routing here for booking the room to those

// then selects a start and end date and time between which he wants access to the room.
6. selection forms? for the user to select and to book a room start and end:
7. this end date and time can only be 4 hours apart max
8. it can also not overlap with another user having already booked the room. 

// He is then charged 2 EUR for each hour he booked the room.
9. keeping in mind he needs to be charged 2 €/h of booking
10. we need to check his credit before he can book. 
11. after that check is okay they need to be charged 2 €/hour of booking.





Important to check:

members are the only ones eligible to book exclusive rooms;
a room can only be booked for a max of 4 hours consecutively. 


The following conditions apply: create unit tests for following functionality 
the rest is just dependent on building the code 

- Rooms marked as premium can only be hired for premium members
- No room can be booked for more than 4 hours 
- Check if they can afford the rent for the room
- Room can only be booked if no other User has already booked it in this time (this is the most difficult condition)

***For all these conditions try to use Test Driven Development first.***

Let's do the first requirement together! *Basic unit test example*

"Rooms marked as premium can only be hired for premium members"

First I am going to write my tests, without even writing any real application code!
I will obviously need both a User, and a Room object.
I decided it makes the most sense if the function to check room availability is on the room object.

***The code below expects the constructor of Room & User to require a boolean to set their premium status. ***

So I create a new class called RoomAvailabilityTest inside the `tests/` directory.

```php 
//class has to end with Test
class CheckRoomAvailabilityTest extends TestCase
{
    /**
     * function has to start with Test
     */
    public function testPremiumRoom(): void
    {
        $room = new Room(false);
        $user = new User(false);

        $this->assertTrue($room->canBook($user));
    }
}
```

At this point the test will of course fail, because we don't even have a function `canBook()` in the Room class.
So let us create this with some simple logic to pass the first test:

```php 
class Room {
    function canBook(User $user) {
        return true;
    }
}
```

While the test will succeed now, of course this is not that useful! The function always returns true for now.
Let us create a new test to make sure we check both conditions (fail & success).

```php 
//class has to end with Test
class CheckRoomAvailabilityTest extends TestCase
{
    /**
     * function has to start with Test
     */
    public function testPremiumRoom(): void;
    {
        $room = new Room(false);
        $user = new User(false);

        $this->assertTrue($room->canBook($user));

        $room = new Room(true);//premium room, with no premium user
        $user = new User(false);

        $this->assertFalse($room->canBook($user));
    }
}
```

```php 
class Room {
    function canBook(User $user) {
        return ($this->isPremium() && $user->isPremium()) || !$this->isPremium();
    }
}
```

Ending some more use cases in our tests, and we end up with this end result:

```php 
//class has to end with Test
class CheckRoomAvailabilityTest extends TestCase
{
    private function dataProviderForPremiumRoom() : array
    {
        return [
            [true, true, true],
            [false, false, true],
            [false, true, true],
            [true, false, false]
        ];
    }

    /**
     * function has to start with Test
     * @dataProvider dataProviderForPremiumRoom
     */
    public function testPremiumRoom(bool $roomVar, bool $userVar, bool $expectedOutput): void{

        $room = new Room($roomVar);
        $user = new User($userVar);

        $this->assertEquals($expectedOutput, $room->canBook($user));
    }
}
```

### Edge cases
When you are done with the original requirements, start thinking about the edge cases
- What if somebody needs all their credit to pay for a rental?
- What if somebody enters an end date to start before the start date
- What if the dates of 2 bookings match exactly.
- What if somebody gives a negative number to addCredit (nice to have, see below)

## Nice to have
- Provide a page where the user can recharge his credit. Write a unit test for this!
- Create an admin role that can manage the rooms. In symfony you could use the `make:crud` command for this.

