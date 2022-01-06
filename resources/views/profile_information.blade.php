@extends('layouts.app')

@section('title', 'ကျောင်းသားစီမံခန့်ခွဲမှုစနစ်')

@push('styles')
<style>
    input[type="date"]::-webkit-datetime-edit, input[type="date"]::-webkit-inner-spin-button, input[type="date"]::-webkit-clear-button {
        color: #fff;
        position: relative;
    }

    input[type="date"]::-webkit-datetime-edit-year-field {
        position: absolute !important;
        border-left:1px solid #8c8c8c;
        padding: 2px;
        color:#000;
        left: 56px;
    }

    input[type="date"]::-webkit-datetime-edit-month-field {
        position: absolute !important;
        border-left:1px solid #8c8c8c;
        padding: 2px;
        color:#000;
        left: 26px;
    }

    input[type="date"]::-webkit-datetime-edit-day-field {
        position: absolute !important;
        color:#000;
        padding: 2px;
        left: 4px;
    }

    .btn-xs {

        font-size: 12px;
    }
    .custom-form-group{
        display:flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .custom-form-data{
        display:flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
    }

    .custom-form-data select{
        flex-basis: 50%;
        margin-right: 2px
    }

    .custom-form-group label {
        flex-basis: 35%;
        margin: 0px;
        font-size: 11px;
        align-self: center;
    }

    .students, .father, .mother {
        border-radius: 15px;
        border: 2px dashed #dddddd;
        padding: 15px;
    }

    select.form-control:not([size]):not([multiple]) {
    height: unset!important;
    }

    .form-control {
    padding: 0.375rem 0.05rem!important;
    font-size: 10px;
    }

    button, input, optgroup, select, textarea {
        margin-top: 16px;
    }
</style>
@endpush

@section('content')
    @php
        if(!empty($oldData))
            foreach ($oldData as $key => $value)
                old($key) = $value;
            endforeach
        endif
    @endphp

    <div class="container-fluid">
        <div class="col-md-12 mx-auto">
            <form action="{{ route('entrance.save') }}" method="POST">
                @csrf
                <input type="hidden" name="form_name" value="profile_information">

                <div class="card mb-3 border border-success">
                    <div class="card-body">
                        <h5 class="card-title"><strong>၀င်ခွင့်လျှောက်ထားသူနှင့်သက်ဆိုင်သောအချက်အလက်များ</strong></h5>

                        <div class="row">
                            <div class="col-md-4 separate-div">
                                <div class="students">
                                    <h6 class="text-center">ကျောင်းသား/သူ</h6>
                                    <div class="custom-form-group">
                                        <label class="text-dark">အမည် (မြန်မာ)
                                            <span class="text-danger">*</span>
                                        </label>

                                        <div class="custom-form-data">
                                            <select name="name_title_mm" class="form-control form-control-sm">
                                                <option value="">---</option>
                                                <option value="မ" {{ old('name_title_mm') == 'မ' ? 'selected' : '' }}>မ</option>
                                                <option value="ကို" {{ old('name_title_mm') == 'ကို' ? 'selected' : '' }}>ကို</option>
                                            </select>

                                            <input type="text" name="name_mm" value="{{ old('name_mm')  ? old('name_mm') : '' }}" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="custom-form-group">
                                        <label class="col-form-label text-dark">(အင်္ဂလိပ်)
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="custom-form-data">
                                            <select name="name_title_en" class="form-control-sm form-control" required>
                                                <option value="">----</option>
                                                <option value="Ma" {{ old('name_title_en') == 'Ma' ? 'selected' : '' }}>Ma</option>
                                                <option value="Ko" {{ old('name_title_en') == 'Ko' ? 'selected' : '' }}>Ko</option>
                                            </select>
                                            <input type="text" name="name_en" value="{{ old('name_en') ? old('name_en') : '' }}" class="form-control" placeholder="" required>
                                        </div>
                                    </div>

                                    <div class="custom-form-group">
                                        <label class="col-form-label text-dark">နိုင်ငံသားစိစစ်ရေးကတ်ပြားအမှတ်
                                            <span class="text-danger">*</span>
                                        </label>

                                        <select name="nrc_holding_status_mm" class="form-control nrc-check-select" required>
                                            <option value="">----</option>
                                            <option value="1" {{ old('nrc_holding_status_mm') == '1' ? 'selected' : '' }}>ရှိ</option>
                                            <option value="0" {{ old('nrc_holding_status_mm') == '0' ? 'selected' : '' }}>မရှိ</option>
                                        </select>
                                    </div>

                                    <div class="custom-form-group">
                                        <label class="col-form-label text-dark">(မြန်မာ)
                                            <span class="text-danger">*</span>
                                        </label>

                                        <div class="custom-form-data">
                                            <select name="nrc_region_mm" class="form-control nrc-region-select mm-lang nrc-input" required>
                                                <option value="">----</option>
                                                <option value="၁" {{ old('nrc_region_mm') == '၁' ? 'selected' : '' }}>၁</option>
                                                <option value="၂" {{ old('nrc_region_mm') == '၂' ? 'selected' : '' }}>၂</option>
                                                <option value="၃" {{ old('nrc_region_mm') == '၃' ? 'selected' : '' }}>၃</option>
                                                <option value="၄" {{ old('nrc_region_mm') == '၄' ? 'selected' : '' }}>၄</option>
                                                <option value="၅" {{ old('nrc_region_mm') == '၅' ? 'selected' : '' }}>၅</option>
                                                <option value="၆" {{ old('nrc_region_mm') == '၆' ? 'selected' : '' }}>၆</option>
                                                <option value="၇" {{ old('nrc_region_mm') == '၇' ? 'selected' : '' }}>၇</option>
                                                <option value="၈" {{ old('nrc_region_mm') == '၈' ? 'selected' : '' }}>၈</option>
                                                <option value="၉" {{ old('nrc_region_mm') == '၉' ? 'selected' : '' }}>၉</option>
                                                <option value="၁၀" {{ old('nrc_region_mm') == '၁၀' ? 'selected' : '' }}>၁၀</option>
                                                <option value="၁၁" {{ old('nrc_region_mm') == '၁၁' ? 'selected' : '' }}>၁၁</option>
                                                <option value="၁၂" {{ old('nrc_region_mm') == '၁၂' ? 'selected' : '' }}>၁၂</option>
                                                <option value="၁၃" {{ old('nrc_region_mm') == '၁၃' ? 'selected' : '' }}>၁၃</option>
                                                <option value="၁၄" {{ old('nrc_region_mm') == '၁၄' ? 'selected' : '' }}>၁၄</option>
                                            </select>

                                            <select name="nrc_township_mm" class="form-control nrc-township-select nrc-input" required>
                                                <option value="">----</option>
                                            </select>

                                            <select name="nrc_type_mm" class="form-control nrc-input" required>
                                                <option value="">----</option>
                                                <option value="နိုင်" {{ old('nrc_type_mm') == 'နိုင်' ? 'selected' : '' }}>နိုင်</option>
                                            </select>

                                            <input type="text" name="nrc_number_mm" value="{{ old('nrc_number_mm') ? old('nrc_number_mm') : '' }}" class="form-control nrc-input" placeholder="" required>
                                        </div>
                                    </div>

                                    <div class="custom-form-group">
                                        <label class="col-form-label text-dark">(အင်္ဂလိပ်)
                                            <span class="text-danger">*</span>
                                        </label>

                                        <div class="custom-form-data">
                                            <select name="nrc_region_en" class="form-control nrc-region-select en-lang nrc-input" required>
                                                <option value="">----</option>
                                                <option value="1" {{ old('nrc_region_mm') == '1' ? 'selected' : '' }}>1</option>
                                                <option value="2" {{ old('nrc_region_mm') == '2' ? 'selected' : '' }}>2</option>
                                                <option value="3" {{ old('nrc_region_mm') == '3' ? 'selected' : '' }}>3</option>
                                                <option value="4" {{ old('nrc_region_mm') == '4' ? 'selected' : '' }}>4</option>
                                                <option value="5" {{ old('nrc_region_mm') == '5' ? 'selected' : '' }}>5</option>
                                                <option value="6" {{ old('nrc_region_mm') == '6' ? 'selected' : '' }}>6</option>
                                                <option value="7" {{ old('nrc_region_mm') == '7' ? 'selected' : '' }}>7</option>
                                                <option value="8" {{ old('nrc_region_mm') == '8' ? 'selected' : '' }}>8</option>
                                                <option value="9" {{ old('nrc_region_mm') == '9' ? 'selected' : '' }}>9</option>
                                                <option value="10" {{ old('nrc_region_mm') == '10' ? 'selected' : '' }}>10</option>
                                                <option value="11" {{ old('nrc_region_mm') == '11' ? 'selected' : '' }}>11</option>
                                                <option value="12" {{ old('nrc_region_mm') == '12' ? 'selected' : '' }}>12</option>
                                                <option value="13" {{ old('nrc_region_mm') == '13' ? 'selected' : '' }}>13</option>
                                                <option value="14" {{ old('nrc_region_mm') == '14' ? 'selected' : '' }}>14</option>
                                            </select>

                                            <select name="nrc_township_en" class="form-control nrc-township-select nrc-input" required>
                                                <option value="">----</option>
                                            </select>

                                            <select name="nrc_type_en" class="form-control nrc-input" required>
                                                <option value="">----</option>
                                                <option value="N" {{ old('nrc_type_en') == 'N' ? 'selected' : '' }}>N</option>
                                            </select>

                                            <input type="text" name="nrc_number_en" value="{{ old('nrc_number_en') ? old('nrc_number_en') : '' }}" class="form-control nrc-input" placeholder="" required>
                                        </div>
                                    </div>

                                    <div class="custom-form-group">
                                        <label class="col-form-label text-dark">လူမျိုး
                                            <span class="text-danger">*</span>
                                        </label>

                                        <select name="race" class="form-control" required>
                                            <option value="">----</option>
                                            <option value="ကချင်" {{ old('race') == 'ကချင်' ? 'selected' : '' }}>ကချင်</option>
                                            <option value="ကယား" {{ old('race') == 'ကယား' ? 'selected' : '' }}>ကယား</option>
                                            <option value="ကရင်" {{ old('race') == 'ကရင်' ? 'selected' : '' }}>ကရင်</option>
                                            <option value="ချင်း" {{ old('race') == 'ချင်း' ? 'selected' : '' }}>ချင်း</option>
                                            <option value="မြန်မာ" {{ old('race') == 'မြန်မာ' ? 'selected' : '' }}>မြန်မာ</option>
                                            <option value="မွန်" {{ old('race') == 'မွန်' ? 'selected' : '' }}>မွန်</option>
                                            <option value="ရခိုင်" {{ old('race') == 'ရခိုင်' ? 'selected' : '' }}>ရခိုင်</option>
                                            <option value="ရှမ်း" {{ old('race') == 'ရှမ်း' ? 'selected' : '' }}>ရှမ်း</option>
                                        </select>
                                    </div>

                                    <div class="custom-form-group">
                                        <label class="col-form-label text-dark">ကိုးကွယ်သည့်ဘာသာ
                                            <span class="text-danger">*</span>
                                        </label>

                                        <select name="religion" class="form-control" required>
                                            <option value="">----</option>
                                            <option value="ဗုဒ္ဓ" {{ old('religion') == 'ဗုဒ္ဓ' ? 'selected' : '' }}>ဗုဒ္ဓ</option>
                                            <option value="ဟိန္ဒူ" {{ old('religion') == 'ဟိန္ဒူ' ? 'selected' : '' }}>ဟိန္ဒူ</option>
                                            <option value="မွတ်ဆလင်" {{ old('religion') == 'မွတ်ဆလင်' ? 'selected' : '' }}>မွတ်ဆလင်</option>
                                            <option value="ခရစ်ယာန်" {{ old('religion') == 'ခရစ်ယာန်' ? 'selected' : '' }}>ခရစ်ယာန်</option>
                                        </select>
                                    </div>

                                    <div class="custom-form-group">
                                        <label class="col-form-label text-dark adjust_label">မွေးသက္ကရာဇ်
                                            <span class="text-danger">*</span>
                                        </label>

                                        <input type="date" name="date_of_birth" value="{{ old('date_of_birth') ? old('date_of_birth') : '' }}" class="form-control " value="" required>
                                    </div>

                                    <div class="custom-form-group">
                                        <label class="col-form-label text-dark">အလုပ်အကိုင်
                                            <span class="text-danger">*</span>
                                        </label>

                                        <input type="text" name="job" value="{{ old('job') ? old('job') : '' }}" class="form-control " placeholder="" required>
                                    </div>

                                    <div class="custom-form-group">
                                        <label class="col-form-label text-dark adjust_label">
                                            ဆက်သွယ်ရန်ဖုန်းနံပါတ်
                                            <span class="text-danger">*</span>
                                        </label>

                                        <input type="text" name="contact_phone" value="{{ old('contact_phone') ? old('contact_phone') : '' }}" class="form-control " placeholder="" required>
                                    </div>

                                    <div class="custom-form-group">
                                        <label class="col-form-label text-dark adjust_label">အီးမေးလ်လိပ်စာ
                                            <span class="text-danger">*</span>
                                        </label>

                                        <input type="email" name="email" value="{{ old('email') ? old('email') : '' }}" class="form-control" placeholder="" required>
                                    </div>

                                    <div class="custom-form-group">
                                        <label class="col-form-label text-dark adjust_label">ဆက်သွယ်ရန်လိပ်စာ
                                            <span class="text-danger">*</span>
                                        </label>

                                        <textarea name="address" value="{{ old('address') ? old('address') : '' }}" class="form-control" rows="3" required></textarea>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-4 separate-div">
                                <div class="father">
                                    <h6 class="text-center">အဘ</h6>
                                    <div class="custom-form-group">
                                        <div class="custom-form-data">
                                            <select name="father_name_title_mm" class="form-control parent-minimal-mandatory-input" required>
                                                <option value="">----</option>
                                                <option value="ဦး" {{ old('father_name_title_mm') == 'ဦး' ? 'selected' : '' }}>ဦး</option>
                                            </select>
                                            <input type="text" name="father_name_mm" value="{{ old('father_name_mm') ? old('father_name_mm') : '' }}" class="form-control parent-minimal-mandatory-input" placeholder="" required>
                                        </div>
                                    </div>

                                    <div class="custom-form-group">
                                        <div class="custom-form-data">
                                            <select name="father_name_title_en" class="form-control parent-minimal-mandatory-input" required>
                                                <option value="">----</option>
                                                <option value="U" {{ old('father_name_title_en') == 'U' ? 'selected' : '' }}>U</option>
                                            </select>
                                            <input type="text" name="father_name_en" value="{{ old('father_name_en') ? old('father_name_en') : '' }}" class="form-control parent-minimal-mandatory-input" placeholder="" required>
                                        </div>
                                    </div>

                                    <div class="custom-form-group">
                                        <select name="father_death_status" class="form-control parent-death-status-select parent-minimal-mandatory-input" required>
                                            <option value="">----</option>
                                            <option value="1" {{ old('father_death_status') == '1' ? 'selected' : '' }}>သက်ရှိ</option>
                                            <option value="0" {{ old('father_death_status') == '0' ? 'selected' : '' }}>ကွယ်လွန်</option>
                                        </select>
                                    </div>

                                    <div class="custom-form-group">
                                        <div class="custom-form-data">
                                            <select name="father_nrc_region_mm" class="form-control nrc-region-select mm-lang nrc-input parent-minimal-mandatory-input" required>
                                                <option value="">----</option>
                                                <option value="၁" {{ old('father_nrc_region_mm') == '၁' ? 'selected' : '' }}>၁</option>
                                                <option value="၂" {{ old('father_nrc_region_mm') == '၂' ? 'selected' : '' }}>၂</option>
                                                <option value="၃" {{ old('father_nrc_region_mm') == '၃' ? 'selected' : '' }}>၃</option>
                                                <option value="၄" {{ old('father_nrc_region_mm') == '၄' ? 'selected' : '' }}>၄</option>
                                                <option value="၅" {{ old('father_nrc_region_mm') == '၅' ? 'selected' : '' }}>၅</option>
                                                <option value="၆" {{ old('father_nrc_region_mm') == '၆' ? 'selected' : '' }}>၆</option>
                                                <option value="၇" {{ old('father_nrc_region_mm') == '၇' ? 'selected' : '' }}>၇</option>
                                                <option value="၈" {{ old('father_nrc_region_mm') == '၈' ? 'selected' : '' }}>၈</option>
                                                <option value="၉" {{ old('father_nrc_region_mm') == '၉' ? 'selected' : '' }}>၉</option>
                                                <option value="၁၀" {{ old('father_nrc_region_mm') == '၁၀' ? 'selected' : '' }}>၁၀</option>
                                                <option value="၁၁" {{ old('father_nrc_region_mm') == '၁၁' ? 'selected' : '' }}>၁၁</option>
                                                <option value="၁၂" {{ old('father_nrc_region_mm') == '၁၂' ? 'selected' : '' }}>၁၂</option>
                                                <option value="၁၃" {{ old('father_nrc_region_mm') == '၁၃' ? 'selected' : '' }}>၁၃</option>
                                                <option value="၁၄" {{ old('father_nrc_region_mm') == '၁၄' ? 'selected' : '' }}>၁၄</option>
                                            </select>

                                            <select name="father_nrc_township_mm" class="form-control nrc-township-select nrc-input parent-minimal-mandatory-input" required>
                                                <option value="">----</option>
                                            </select>

                                            <select name="father_nrc_type_mm" class="form-control nrc-input parent-minimal-mandatory-input" required>
                                                <option value="">----</option>
                                                <option value="နိုင်" {{ old('father_nrc_type_mm') == 'နိုင်' ? 'selected' : '' }}>နိုင်</option>
                                            </select>

                                            <input type="text" name="father_nrc_number_mm" value="{{ old('father_nrc_number_mm') ? old('father_nrc_number_mm') : '' }}" class="form-control nrc-input parent-minimal-mandatory-input" placeholder="" required>
                                        </div>
                                    </div>

                                    <div class="custom-form-group">
                                        <div class="custom-form-data">
                                            <select name="father_nrc_region_en" class="form-control nrc-region-select en-lang nrc-input parent-minimal-mandatory-input" required>
                                                <option value="">----</option>
                                                <option value="1" {{ old('father_nrc_region_en') == '1' ? 'selected' : '' }}>1</option>
                                                <option value="2" {{ old('father_nrc_region_en') == '2' ? 'selected' : '' }}>2</option>
                                                <option value="3" {{ old('father_nrc_region_en') == '3' ? 'selected' : '' }}>3</option>
                                                <option value="4" {{ old('father_nrc_region_en') == '4' ? 'selected' : '' }}>4</option>
                                                <option value="5" {{ old('father_nrc_region_en') == '5' ? 'selected' : '' }}>5</option>
                                                <option value="6" {{ old('father_nrc_region_en') == '6' ? 'selected' : '' }}>6</option>
                                                <option value="7" {{ old('father_nrc_region_en') == '7' ? 'selected' : '' }}>7</option>
                                                <option value="8" {{ old('father_nrc_region_en') == '8' ? 'selected' : '' }}>8</option>
                                                <option value="9" {{ old('father_nrc_region_en') == '9' ? 'selected' : '' }}>9</option>
                                                <option value="10" {{ old('father_nrc_region_en') == '10' ? 'selected' : '' }}>10</option>
                                                <option value="11" {{ old('father_nrc_region_en') == '11' ? 'selected' : '' }}>11</option>
                                                <option value="12" {{ old('father_nrc_region_en') == '12' ? 'selected' : '' }}>12</option>
                                                <option value="13" {{ old('father_nrc_region_en') == '13' ? 'selected' : '' }}>13</option>
                                                <option value="14" {{ old('father_nrc_region_en') == '14' ? 'selected' : '' }}>14</option>
                                            </select>

                                            <select name="father_nrc_township_en" class="form-control nrc-township-select nrc-input parent-minimal-mandatory-input" required>
                                                <option value="">----</option>
                                            </select>

                                            <select name="father_nrc_type_en" class="form-control nrc-input parent-minimal-mandatory-input" required>
                                                <option value="">----</option>
                                                <option value="N" {{ old('father_nrc_type_en') == 'N' ? 'selected' : '' }}>N</option>
                                            </select>

                                            <input type="text" name="father_nrc_number_en" value="{{ old('father_nrc_number_en') ? old('father_nrc_number_en') : '' }}" class="form-control nrc-input parent-minimal-mandatory-input" placeholder="" required>
                                        </div>
                                    </div>

                                    <div class="custom-form-group">
                                        <select name="father_race" class="form-control parent-minimal-mandatory-input"  required>
                                            <option value="">----</option>
                                            <option value="ကချင်" {{ old('father_race') == 'ကချင်' ? 'selected' : '' }}>ကချင်</option>
                                            <option value="ကယား" {{ old('father_race') == 'ကယား' ? 'selected' : '' }}>ကယား</option>
                                            <option value="ကရင်" {{ old('father_race') == 'ကရင်' ? 'selected' : '' }}>ကရင်</option>
                                            <option value="ချင်း" {{ old('father_race') == 'ချင်း' ? 'selected' : '' }}>ချင်း</option>
                                            <option value="မြန်မာ" {{ old('father_race') == 'မြန်မာ' ? 'selected' : '' }}>မြန်မာ</option>
                                            <option value="မွန်" {{ old('father_race') == 'မွန်' ? 'selected' : '' }}>မွန်</option>
                                            <option value="ရခိုင်" {{ old('father_race') == 'ရခိုင်' ? 'selected' : '' }}>ရခိုင်</option>
                                            <option value="ရှမ်း" {{ old('father_race') == 'ရှမ်း' ? 'selected' : '' }}>ရှမ်း</option>
                                        </select>
                                    </div>

                                    <div class="custom-form-group">
                                        <select name="father_religion" class="form-control parent-minimal-mandatory-input" required>
                                            <option value="">----</option>
                                            <option value="ဗုဒ္ဓ" {{ old('father_religion') == 'ဗုဒ္ဓ' ? 'selected' : '' }}>ဗုဒ္ဓ</option>
                                            <option value="ဟိန္ဒူ" {{ old('father_religion') == 'ဟိန္ဒူ' ? 'selected' : '' }}>ဟိန္ဒူ</option>
                                            <option value="မွတ်ဆလင်" {{ old('father_religion') == 'မွတ်ဆလင်' ? 'selected' : '' }}>မွတ်ဆလင်</option>
                                            <option value="ခရစ်ယာန်" {{ old('father_religion') == 'ခရစ်ယာန်' ? 'selected' : '' }}>ခရစ်ယာန်</option>
                                        </select>
                                    </div>

                                    <div class="custom-form-group">
                                        <input type="date" name="father_date_of_birth" value="{{ old('father_date_of_birth') ? old('father_date_of_birth') : '' }}" class="form-control" value="" required>
                                    </div>

                                    <div class="custom-form-group">
                                        <input type="text" name="father_job" value="{{ old('father_job') ? old('father_job') : '' }}" class="form-control" placeholder="" required>
                                    </div>

                                    <div class="custom-form-group">
                                        <input type="text" name="father_contact_phone" value="{{ old('father_contact_phone') ? old('father_contact_phone') : '' }}" class="form-control" placeholder="" required>
                                    </div>

                                    <div class="custom-form-group">
                                        <input type="email" name="father_email" value="{{ old('father_email') ? old('father_email') : '' }}" class="form-control" placeholder="" required>
                                    </div>

                                    <div class="custom-form-group">
                                        <textarea name="father_address" value="{{ old('father_address') ? old('father_address') : '' }}" class="form-control" rows="3" required></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 separate-div">
                                <div class="mother">
                                    <h6 class="text-center">အမိ</h6>
                                    <div class="custom-form-group">
                                        <div class="custom-form-data">
                                            <select name="mother_name_title_mm" class="form-control parent-minimal-mandatory-input" required>
                                                <option value="">----</option>
                                                <option value="ဒေါ်" {{ old('mother_name_title_mm') == 'ဒေါ်' ? 'selected' : '' }}>ဒေါ်</option>
                                            </select>
                                            <input type="text" name="mother_name_mm" value="{{ old('mother_name_mm') ? old('mother_name_mm') : '' }}" class="form-control parent-minimal-mandatory-input" placeholder="" required>
                                        </div>
                                    </div>

                                    <div class="custom-form-group">
                                        <div class="custom-form-data">
                                            <select name="mother_name_title_en" class="form-control parent-minimal-mandatory-input" required>
                                                <option value="">----</option>
                                                <option value="Daw" {{ old('mother_name_title_en') == 'Daw' ? 'selected' : '' }}>Daw</option>
                                            </select>

                                            <input type="text" name="mother_name_en" value="{{ old('mother_name_en') ? old('mother_name_en') : '' }}" class="form-control parent-minimal-mandatory-input" placeholder="" required>
                                        </div>
                                    </div>

                                    <div class="custom-form-group">
                                        <select name="mother_death_status" class="form-control parent-death-status-select parent-minimal-mandatory-input" required>
                                            <option value="">----</option>
                                            <option value="1" {{ old('mother_death_status') == '1' ? 'selected' : '' }}>သက်ရှိ</option>
                                            <option value="0" {{ old('mother_death_status') == '0' ? 'selected' : '' }}>ကွယ်လွန်</option>
                                        </select>
                                    </div>

                                    <div class="custom-form-group">
                                        <div class="custom-form-data">
                                            <select name="mother_nrc_region_mm" class="form-control nrc-region-select mm-lang nrc-input parent-minimal-mandatory-input" required>
                                                <option value="">----</option>
                                                <option value="၁" {{ old('mother_nrc_region_mm') == '၁' ? 'selected' : '' }}>၁</option>
                                                <option value="၂" {{ old('mother_nrc_region_mm') == '၂' ? 'selected' : '' }}>၂</option>
                                                <option value="၃" {{ old('mother_nrc_region_mm') == '၃' ? 'selected' : '' }}>၃</option>
                                                <option value="၄" {{ old('mother_nrc_region_mm') == '၄' ? 'selected' : '' }}>၄</option>
                                                <option value="၅" {{ old('mother_nrc_region_mm') == '၅' ? 'selected' : '' }}>၅</option>
                                                <option value="၆" {{ old('mother_nrc_region_mm') == '၆' ? 'selected' : '' }}>၆</option>
                                                <option value="၇" {{ old('mother_nrc_region_mm') == '၇' ? 'selected' : '' }}>၇</option>
                                                <option value="၈" {{ old('mother_nrc_region_mm') == '၈' ? 'selected' : '' }}>၈</option>
                                                <option value="၉" {{ old('mother_nrc_region_mm') == '၉' ? 'selected' : '' }}>၉</option>
                                                <option value="၁၀" {{ old('mother_nrc_region_mm') == '၁၀' ? 'selected' : '' }}>၁၀</option>
                                                <option value="၁၁" {{ old('mother_nrc_region_mm') == '၁၁' ? 'selected' : '' }}>၁၁</option>
                                                <option value="၁၂" {{ old('mother_nrc_region_mm') == '၁၂' ? 'selected' : '' }}>၁၂</option>
                                                <option value="၁၃" {{ old('mother_nrc_region_mm') == '၁၃' ? 'selected' : '' }}>၁၃</option>
                                                <option value="၁၄" {{ old('mother_nrc_region_mm') == '၁၄' ? 'selected' : '' }}>၁၄</option>
                                            </select>

                                            <select name="mother_nrc_township_mm" class="form-control nrc-township-select nrc-input parent-minimal-mandatory-input" required>
                                                <option value="">----</option>
                                            </select>

                                            <select name="mother_nrc_type_mm" class="form-control nrc-input parent-minimal-mandatory-input" required>
                                                <option value="">----</option>
                                                <option value="နိုင်" {{ old('mother_nrc_type_mm') == 'နိုင်' ? 'selected' : '' }}>နိုင်</option>
                                            </select>

                                            <input type="text" name="mother_nrc_number_mm" value="{{ old('mother_nrc_number_mm') ? old('mother_nrc_number_mm') : '' }}" class="form-control nrc-input parent-minimal-mandatory-input" placeholder="" required>
                                        </div>
                                    </div>

                                    <div class="custom-form-group">
                                        <div class="custom-form-data">
                                            <select name="mother_nrc_region_en" class="form-control nrc-region-select en-lang nrc-input parent-minimal-mandatory-input" required>
                                                <option value="">----</option>
                                                <option value="1" {{ old('mother_nrc_region_en') == '1' ? 'selected' : '' }}>1</option>
                                                <option value="2" {{ old('mother_nrc_region_en') == '2' ? 'selected' : '' }}>2</option>
                                                <option value="3" {{ old('mother_nrc_region_en') == '3' ? 'selected' : '' }}>3</option>
                                                <option value="4" {{ old('mother_nrc_region_en') == '4' ? 'selected' : '' }}>4</option>
                                                <option value="5" {{ old('mother_nrc_region_en') == '5' ? 'selected' : '' }}>5</option>
                                                <option value="6" {{ old('mother_nrc_region_en') == '6' ? 'selected' : '' }}>6</option>
                                                <option value="7" {{ old('mother_nrc_region_en') == '7' ? 'selected' : '' }}>7</option>
                                                <option value="8" {{ old('mother_nrc_region_en') == '8' ? 'selected' : '' }}>8</option>
                                                <option value="9" {{ old('mother_nrc_region_en') == '9' ? 'selected' : '' }}>9</option>
                                                <option value="10" {{ old('mother_nrc_region_en') == '10' ? 'selected' : '' }}>10</option>
                                                <option value="11" {{ old('mother_nrc_region_en') == '11' ? 'selected' : '' }}>11</option>
                                                <option value="12" {{ old('mother_nrc_region_en') == '12' ? 'selected' : '' }}>12</option>
                                                <option value="13" {{ old('mother_nrc_region_en') == '13' ? 'selected' : '' }}>13</option>
                                                <option value="14" {{ old('mother_nrc_region_en') == '14' ? 'selected' : '' }}>14</option>
                                            </select>

                                            <select name="mother_nrc_township_en" class="form-control nrc-township-select nrc-input parent-minimal-mandatory-input" required>
                                                <option value="">----</option>
                                            </select>

                                            <select name="mother_nrc_type_en" class="form-control nrc-input parent-minimal-mandatory-input" required>
                                                <option value="">----</option>
                                                <option value="N" {{ old('mother_nrc_type_en') == 'N' ? 'selected' : '' }}>N</option>
                                            </select>

                                            <input type="text" name="mother_nrc_number_en" value="{{ old('mother_nrc_number_en') ? old('mother_nrc_number_en') : '' }}" class="form-control nrc-input parent-minimal-mandatory-input"  placeholder="" required>
                                        </div>
                                    </div>

                                    <div class="custom-form-group">
                                        <select name="mother_race" class="form-control parent-minimal-mandatory-input" required>
                                            <option value="">----</option>
                                            <option value="ကချင်" {{ old('mother_race') == 'ကချင်' ? 'selected' : '' }}>ကချင်</option>
                                            <option value="ကယား" {{ old('mother_race') == 'ကယား' ? 'selected' : '' }}>ကယား</option>
                                            <option value="ကရင်" {{ old('mother_race') == 'ကရင်' ? 'selected' : '' }}>ကရင်</option>
                                            <option value="ချင်း" {{ old('mother_race') == 'ချင်း' ? 'selected' : '' }}>ချင်း</option>
                                            <option value="မြန်မာ" {{ old('mother_race') == 'မြန်မာ' ? 'selected' : '' }}>မြန်မာ</option>
                                            <option value="မွန်" {{ old('mother_race') == 'မွန်' ? 'selected' : '' }}>မွန်</option>
                                            <option value="ရခိုင်" {{ old('mother_race') == 'ရခိုင်' ? 'selected' : '' }}>ရခိုင်</option>
                                            <option value="ရှမ်း" {{ old('mother_race') == 'ရှမ်း' ? 'selected' : '' }}>ရှမ်း</option>
                                        </select>
                                    </div>

                                    <div class="custom-form-group">
                                        <select name="mother_religion" class="form-control parent-minimal-mandatory-input" required>
                                            <option value="">----</option>
                                            <option value="ဗုဒ္ဓ" {{ old('mother_religion') == 'ဗုဒ္ဓ' ? 'selected' : '' }}>ဗုဒ္ဓ</option>
                                            <option value="ဟိန္ဒူ" {{ old('mother_religion') == 'ဟိန္ဒူ' ? 'selected' : '' }}>ဟိန္ဒူ</option>
                                            <option value="မွတ်ဆလင်" {{ old('mother_religion') == 'မွတ်ဆလင်' ? 'selected' : '' }}>မွတ်ဆလင်</option>
                                            <option value="ခရစ်ယာန်" {{ old('mother_religion') == 'ခရစ်ယာန်' ? 'selected' : '' }}>ခရစ်ယာန်</option>
                                        </select>
                                    </div>

                                    <div class="custom-form-group">
                                        <input type="date" name="mother_date_of_birth" value="{{ old('mother_date_of_birth') ? old('mother_date_of_birth') : '' }}" class="form-control" value="" required>
                                    </div>

                                    <div class="custom-form-group">
                                        <input type="text" name="mother_job" value="{{ old('mother_job') ? old('mother_job') : '' }}"  class="form-control" placeholder="" required>
                                    </div>

                                    <div class="custom-form-group">
                                        <input type="text" name="mother_contact_phone" value="{{ old('mother_contact_phone') ? old('mother_contact_phone') : '' }}"  class="form-control" placeholder="" required>
                                    </div>

                                    <div class="custom-form-group">
                                        <input type="email" name="mother_email" value="{{ old('mother_email') ? old('mother_email') : '' }}"  class="form-control" placeholder="" required>
                                    </div>

                                    <div class="custom-form-group">
                                        <textarea name="mother_address" value="{{ old('mother_address') ? old('mother_address') : '' }}"  class="form-control" rows="3" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="float-right mb-lg-5">
                    <button type="submit" class="btn btn-primary btn-xs">နောက်တမျက်နှာသို့</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(function () {

        var nrc_options_mm = {!! json_encode($nrcOptionsMM) !!};
        var nrc_options_en = {!! json_encode($nrcOptionsEN) !!};
        $('.separate-div:first').find('.nrc-input').prop('disabled', true);

        $('.nrc-region-select').change(function () {

            options = [];
            if($(this).hasClass('mm-lang')) {
                options = nrc_options_mm[$(this).val()];
            } else if ($(this).hasClass('en-lang')) {
                options = nrc_options_en[$(this).val()];
            }

            selectBox = $(this).next('.nrc-township-select');
            selectBox.prop('disabled', false);
            selectBox.children('option').remove();
            options.forEach(function (value, index, array) {
                selectBox.append(new Option(value, value));
            });
        });

        $('.nrc-check-select').change(function () {

            rootDiv = $(this).parents('.separate-div');
            if ($(this).val() == '1') {
                rootDiv.find('.nrc-input').prop('disabled', false);
                rootDiv.find('.nrc-input').prop('required', true);
            } else {
                rootDiv.find('.nrc-input').prop('disabled', true);
            }
        });

        $('.parent-death-status-select').change(function () {

            rootDiv = $(this).parents('.separate-div');
            if ($(this).val() == '1') {

                rootDiv.find('input:not(.parent-minimal-mandatory-input)').prop('disabled', false);
                rootDiv.find('select:not(.parent-minimal-mandatory-input)').prop('disabled', false);
                rootDiv.find('textarea:not(.parent-minimal-mandatory-input)').prop('disabled', false);

            } else {

                rootDiv.find('input:not(.parent-minimal-mandatory-input)').prop('disabled', true);
                rootDiv.find('select:not(.parent-minimal-mandatory-input)').prop('disabled', true);
                rootDiv.find('textarea:not(.parent-minimal-mandatory-input)').prop('disabled', true);
            }
        });
    });
</script>
@endpush
