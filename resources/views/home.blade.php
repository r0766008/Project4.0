@extends('layouts.template')

@section('main')
    <h2>3-IT</h2>
    <p>3-it is a group of people that helps SMEs, entrepreneurs and organisations with their IT needs.</p>
    <p>They help SMEs, entrepreneurs and organisations to get their 'IT-Level'
        on an higher level by combining talent with innovation. 3-it will help you
        with their expert insights, they offer a total solution for all IT-needs. The
        company will make sure that the communication and their personal
        approach will be customer oriented and goes for sustainable and flexible
        solutions who are tailored just for their customers.</p>
    <h2>Logistic Process</h2>
    <h3>Introduction</h3>
    <p>The entire logistic process consists of many steps to ensure that this runs
        smoothly. For our customers this process begins when the truck driver
        arrives at the premises and ends when he leaves the premises. The whole
        process between the arrival and the departure will be automated.</p>
    <h3>Steps</h3>
    <p>As mentioned earlier, this process consists of a lot of steps that will be
        discussed in this section.</p>
    <h4>Step 1: Truckdriver arrives at the premises</h4>
    <p>The first part of the process starts when the truckdriver arrives at the
        premises. When he arrives, he has to wait in front of the barrier. While he
        waits, his number plate will get scanned and his RFID tag will get read. </p>
    <p>The system will check if the truck is already in the database. If the truck
        is found in the database, then the system will go further to the next step.
        If the truck is not found in the database, then the system will show a popup window on the dashboard were the logistics employee has to fill in the
        data about the truck (number-plate, company, RFID-information).</p>
    <p>When the truck is identified, the system will show the loading bay
        number on a screen at the entrance (in the checkpoint, …). Meanwhile
        the light on the bay will turn on and the gate of the bay will open. </p>
    <p>On the program, the bay will get marked as “In use”.</p>
    <h4>Step 2: Truckdriver drives to loading bay</h4>
    <p>After step 1 is finished, the barrier at the entrance will open and the
        truckdriver can drive to the assigned gate. When he arrives, they can
        load/unload the truck as usual and the truckdriver can leave the bay
        when ready.</p>
    <h4>Step 3: Truckdriver leaves the premises</h4>
    <p>When the truck driver arrives at the exit he will have to wait in front of
        the barrier. While he waits, his number plate will get scanned and his
        RFID tag will get read. </p>
    <p>When the system has identified the truck, the barrier will open and the
        truckdriver can leave the premises.</p>
    <p>Meanwhile the loading bay light will turn off and the gate at the bay will
        close again (if not manually closed). </p>
    <p>On the program, the bay will get marked as “Not in use” and the truck
        will be added to the page marked as “Finished”.</p>
@endsection
