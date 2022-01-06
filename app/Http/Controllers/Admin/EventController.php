<?php

namespace App\Http\Controllers\Admin;

use App\Event;
use DateTime;
use DatePeriod;
use DateInterval;
use App\Http\Requests\StoreEvent;
use App\Http\Requests\UpdateEvent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eventsQuery = Event::orderBy('created_at', 'DESC');
        $events = $eventsQuery->get();
        $eventsPaginated = $eventsQuery->paginate(10);
        $eventsArr = [];

        if ($events->count() > 0) {
            foreach ($events as $key => $value) {
                $eventsArr[] = [
                    'title' => $value->name,
                    'start' => date('Y-m-d', strtotime($value->from)),
                    'end' => date('Y-m-d', strtotime($value->to . ' +1 day')),
                    'backgroundColor' => '#0073b7', // Blue
                    'borderColor' => '#0073b7', // Blue
                ];
            }
        }

        return view('admin.events.index', compact('eventsArr', 'eventsPaginated'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.events.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEvent $request)
    {
        $data = $request->validated();
        $data['created_by'] = auth()->guard('admin')->user()->id;

        $dates = array(); 
        $period = new DatePeriod(
            new DateTime(date('Y-m-d', strtotime($data['from']))),
            new DateInterval('P1D'),
            new DateTime(date('Y-m-d', strtotime($data['to'])))
        );

        $dates[]['date'] = $data['to'];
        foreach ($period as $key => $value) {
            $dates[]['date'] = $value->format('Y-m-d');
        }

        try {
            
            DB::beginTransaction();
            $event = Event::create($data);
            $event->dates()->createMany($dates);
            DB::commit();

            return redirect()->route('admin.events.index')->with('success', 'ပွဲဖန်တီးမှု အောင်မြင်ခဲ့သည်။');

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::error('Admin Event Store Exception: ' . $e);
            return redirect()->route('admin.events.index')->with('error', 'ပွဲဖန်တီးမှု မအောင်မြင်ခဲ့ပါ။');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEvent $request, Event $event)
    {
        $data = $request->validated();

        try {
            
            DB::beginTransaction();

            // Delete old dates
            $event->dates()->delete();

            $dates = array(); 
            $period = new DatePeriod(
                new DateTime(date('Y-m-d', strtotime($data['from']))),
                new DateInterval('P1D'),
                new DateTime(date('Y-m-d', strtotime($data['to'])))
            );

            $dates[]['date'] = $data['to'];
            foreach ($period as $key => $value) {
                $dates[]['date'] = $value->format('Y-m-d');    
            }

            $event->name = $data['name'];
            $event->from = $data['from'];
            $event->to = $data['to'];
            $event->save();

            $event->dates()->createMany($dates);

            DB::commit();
            return redirect()->route('admin.events.index')->with('success', 'ပွဲ တည်းဖြတ်မှု အောင်မြင်ခဲ့သည်။');

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::error('Admin Event Update Exception: ' . $e);
            return redirect()->route('admin.events.index')->with('error', 'ပွဲ တည်းဖြတ်မှု မအောင်မြင်ခဲ့ပါ။');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        try {

            $event->delete();
            return redirect()->route('admin.events.index')->with('success', 'ဖျက်ခြင်း အောင်မြင်ခဲ့သည်။');

        } catch (\Exception $e) {

            \Log::error('Admin Event Delete Exception: ' . $e);
            return redirect()->route('admin.events.index')->with('error', 'ဖျက်ခြင်း မအောင်မြင်ပါ။');
        }
    }
}
