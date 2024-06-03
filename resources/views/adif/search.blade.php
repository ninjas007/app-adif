@if (!empty($adif))
    {{-- search form --}}
    <form action="{{ url()->current() }}">
        <div class="row">
            <div class="col-auto">
                <div class="form-inline mr-auto">
                    <div class="input-group">
                        <input type="search" class="form-control form-control-lg" name="search"
                            value="{{ request('search') }}" placeholder="Search Call">
                    </div>
                </div>
            </div>
            <div class="col-auto">
                {{-- select form --}}
                <div class="form-inline mr-auto">
                    <div class="input-group">
                        <select name="record" class="form-control form-control-lg">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-lg btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endif
