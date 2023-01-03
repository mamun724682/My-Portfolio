<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Project;
use App\Models\Skill;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FrontendController extends Controller
{
    public function __invoke()
    {
        $user = User::first();
        $experiences = Experience::active()->latest()->get();
        $skills = Skill::active()->whereNull('parent_id')->orderBy('serial')->get();
        $projects = Project::active()->latest()->get();

        // Gitlab
        $gitlab_contributions_api = Http::get('https://gitlab.com/users/abdullahalmamun/calendar.json')->json();
        $gitlab_contributions = [];
        foreach ($gitlab_contributions_api as $date => $count) {
            $gitlab_contributions[] = [
                'timestamp' => Carbon::createFromFormat('Y-m-d', $date)->getTimestampMs(),
                'count'     => $count
            ];
        }

        return view('frontend.index', compact('user', 'experiences', 'skills', 'projects', 'gitlab_contributions'));
    }
}
