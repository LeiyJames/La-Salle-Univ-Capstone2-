<?php

namespace App\Livewire\Pages\Admin\Home;

use Livewire\Component;
use App\Models\Events;
use App\Models\User;
use Carbon\Carbon;

class Index extends Component
{
    public function render()
    {
        $now = Carbon::now();
        $today = $now->toDateString();
        $endOfMonth = $now->copy()->endOfMonth()->toDateString();

        $totalEvents = Events::count();
        $activeEvents = Events::where('events_status', true)->count();
        $upcomingThisMonth = Events::where('events_status', true)
            ->whereDate('events_start_date', '>=', $today)
            ->whereDate('events_start_date', '<=', $endOfMonth)
            ->count();
        $spotlightCount = Events::whereNotNull('events_properties')
            ->where('events_status', true)
            ->count();
        $totalUsers = User::count();
        $studentUsers = User::where('users_role', 'student')->count();

        // 5 most recent events
        $recentEvents = Events::orderBy('created_at', 'desc')->take(5)->get();

        // Active spotlight events
        $spotlightEvents = Events::whereNotNull('events_properties')
            ->where('events_status', true)
            ->orderBy('events_start_date', 'asc')
            ->take(3)
            ->get();

        return view('livewire.pages.admin.home.index', [
            'totalEvents' => $totalEvents,
            'activeEvents' => $activeEvents,
            'upcomingThisMonth' => $upcomingThisMonth,
            'spotlightCount' => $spotlightCount,
            'totalUsers' => $totalUsers,
            'studentUsers' => $studentUsers,
            'recentEvents' => $recentEvents,
            'spotlightEvents' => $spotlightEvents,
        ])->extends('layouts.admin.app');
    }
}
