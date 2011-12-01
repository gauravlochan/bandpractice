Nathaniel School of Music Band Practice
=======================================

This is an app solving the problem of scheduling practice for the Nathaniel show.

It's my first facebook app + first PHP app so forgive all the sins i've committed.  
(feel free to educate though)

Problem
-------

A bunch of school students (vocalists, guitarists, bassists, keyboardists, drummers) who
are practising for the show, and putting on ~20 songs for the show.  A subset of musicians 
sign up to do each song.  Musicians try to coordinate and come in to practice the songs, but
obviously people have very different schedules and can't all come in at the same time.

The problems I want to tackle are:
- Coordination is fragmented/unreliable (post on facebook group, SMSs, phone calls)
- All the musicians required for a song don't show up
- Musicians don't know what songs will happen at the session and so can't prepare (mentally or otherwise)
- A musician may show up and not have *any* folks to do his songs with - waste of a trip


Proposed Solution
-----------------
A facebook app that allows one to schedule a session, musicians can register for the session and
can suggest songs to practise.  The app can also recommend songs based on the musicians present.

A musician can then 'select' a song for a given session, in which case the app will indicate which
musicians are NOT present to do the song.

Entities
--------
* Musician - name, facebook_id, contact number, instrument(s)
* Song - musicians(s), state (proposed, practising, confirmed)
* Session - date, musician(s), song(s)

Flow
----
Let's say songs are numbered from 1-20 and musicians are A-M

Song 1 -> A + B + C + D + E
Song 2 -> A + F + C + G + E
Song 3 -> E + F + H + I
Song 4 -> A + B + C + I

Use case 1: Identify and contact missing musicians for a song.

Musician 'A' can schedule a session for Monday.  A message goes out to everyone and Musician's 'B' 
and 'C' also sign up for the session.

Then 'A' proposes that they practise Song 1.  The app will indicate that 'D' and 'E' are missing.  
One of the musicians can call them and see if they are coming, or consider alternative musicians.


Use case 2: Decide whether to show up
Musician 'H' logs on and sees that no-one is showing for song 3.  So he decides not to attend


Use case 3: Know what to practise for
Musician 'I' registers for the session and sees that A,B,C are also coming.  He adds Song 4 for
the session.  A,B,C get a message about this and practise the song before showing up

Use case 4: Propose new songs (not fully fleshed out)



Notifications:
--------------
The app will be a single coordination interface so everyone knows who is showing up for practise
People can enable SMS notifications if they are not frequent facebook users
People can obviously make phone calls to push others
