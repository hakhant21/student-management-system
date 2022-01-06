<div class="card">
    <h4 class="text-center mt-4 mb-2">အဆင့်မြင့်ရှာဖွေမှု</h4>
    <form action="{{ route('admin.entrance_applications.index') }}" method="GET">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label>အခြေအနေ:</label>
                            <select class="form-control mb-2" name="status">
                                <option value="">----</option>
                                <option value="0" {{ \Request::get('status') == '0' ? 'selected' : '' }}>လျှောက်ထားဆဲ
                                </option>
                                <option value="1" {{ \Request::get('status') == '1' ? 'selected' : '' }}>အတည်ပြုပြီး
                                </option>
                                <option value="2" {{ \Request::get('status') == '2' ? 'selected' : '' }}>ငြင်းပယ်ပြီး
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-group">
                            <label>ရက်စွဲ (မှ):</label>
                            <input type="date" class="form-control" data-date-format="dd/mm/yyyy" name="from" value="{{ \Request::get('from') }}">
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-group">
                            <label>ရက်စွဲ (သို့):</label>
                            <input type="date" class="form-control" data-date-format="dd/mm/yyyy" name="to" value="{{ \Request::get('to') }}">
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-group">
                            <label>ပထမဦးစားပေးဘာသာတွဲ:</label>
                            @if (count($studies))
                                <select class="form-control mb-2" name="study_id">
                                    <option value="">----</option>
                                    @foreach ($studies as $key => $value)
                                        <option value="{{ $key }}"
                                            {{ \Request::get('study_id') == $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="row">
                    <div class="col-9">
                        <div class="form-group">
                            <div class="input-group input-group-lg">
                                <input type="search" class="form-control form-control" placeholder="အမည်၊ အလုပ်အကိုင်၊ ဖုန်း၊ လိပ်စာ (လျှောက်ထားသူ၊ ဖခင်၊ မိခင်)" name="keyword" value="{{ \Request::get('keyword') }}">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <button type="submit" class="btn btn-md btn-primary mt-2">ရှာဖွေပါ။</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>