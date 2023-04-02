<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Generatesop extends Model
{
    use HasFactory;



        protected $table = 'generatesops';

        public const STATUS_SELECT = [
            'Pending' => 'In-Progress',
            'Accepted'   => 'Accepted',
            'Declined'   => 'Declined',
        ];
        protected $dates = [
            'created_at',
            'updated_at',
            'deleted_at',
        ];

        protected $casts=[

            'steps'=>'array',
            'stepsmal'=>'array',
            'desc'=>'array',
            'descmal'=>'array',
            'appendix'=>'array',

        ];

        protected $fillable = [
            'sop_title',
            'business_unit',
           'approved_by',
            'uploaded_by',
            'Employee_id',
            'created_at',
            'status',
            'updated_at',
            'deleted_at',
            'Sop_file',
            'effective_date',
            'version_no',
            'doc_no',
            // SOP details content
            'policy',
            'policymal',
            'purpose',
            'scope',
            'scopemal',
            'review_pro',
            'monitoring',
            'monitoringmal',
            'verification',
            'steps',
            'stepsmal',
            'desc',
            'descmal',
            'img',
            'appendix',
            'folder',
            'Process_owner',
            'Process_exec',
            'revised_by',
            'edited_by',
            'assign_reviewers',
            'assign_approvers',
            'aeon_type',
        ];


}
