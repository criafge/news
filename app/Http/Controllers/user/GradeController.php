<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GradeController extends Controller
{
    public function changeGrade(News $news, $whichGrade)
    {
        $grade = $this->getGrade($news->id);

        $item = $this->whichGrade($whichGrade);

        $grade_create = ['news_id' => $news->id, 'user_id' => Auth::user()->id, $item => true];

        if ($grade !== null) {

            if ($grade->$item === 1) {
                $this->gradeFalse($item, $news, $grade);
            } elseif ($grade->like === 0 && $grade->dislike === 0) {
                $this->gradeTrue($item, $news, $grade);
            } else {
                $this->gradeTrue($item, $news, $grade);
                $this->gradeFalse($this->whichGrade(!$whichGrade), $news, $grade);
            }

            $grade->save();
        } else {
            Grade::create($grade_create);
            $news->$item += 1;
        }
        $news->save();
        return redirect()->back();
    }

    protected function gradeFalse($item, $video, $grade)
    {
        $video->$item -= 1;
        $grade->$item = false;
    }
    protected function gradeTrue($item, $video, $grade)
    {
        $video->$item += 1;
        $grade->$item = true;
    }
    protected function getGrade($id)
    {
        return Auth::user()->grades($id);
    }
    protected function whichGrade($item)
    {
        return $item == true ? 'like' : 'dislike';
    }
}
