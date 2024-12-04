<div>
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Феникс
        @endslot
        @slot('title')
            Главная
        @endslot
    @endcomponent

    <div class="row">
        {{-- <div class="col-lg-3 h-100">
            
        </div> --}}
        <div class="col-lg-5 h-100">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Сессии пользователей</h4>
                    <div class="mt-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5 class="mb-1">{{ $allUsersCount }}</h5>
                                <p class="mb-0 text-muted">Всего</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Пирамида возрастов</h4>
                    <div id="age-gender-diagram" class="mt-3">
                        <div class="diagram-container">
                            @php
                                $groupedData = [];

                                foreach ($ageGroups as $group) {
                                    $title = $group->age_from . ' - ' . $group->age_to;
                                    if ($group->age_to >= 100) {
                                        $title = $group->age_from . '+';
                                    }
                                    $groupedData[$title] = ['male' => 0, 'female' => 0];
                                }

                                foreach ($ageGenderData as $user) {
                                    $birthDate = new DateTime($user->birth_date);
                                    $currentDate = new DateTime();
                                    $age = $currentDate->diff($birthDate)->y;

                                    foreach ($ageGroups as $group) {
                                        $title = $group->age_from . ' - ' . $group->age_to;
                                        if ($group->age_to >= 100) {
                                            $title = $group->age_from . '+';
                                        }
                                        if ($age >= $group->age_from && $age <= $group->age_to) {
                                            $groupedData[$title][$user->gender]++;
                                            break;
                                        }
                                    }
                                }

                                $maxCount = max(
                                    array_map(function ($group) {
                                        return max($group['male'], $group['female']);
                                    }, $groupedData),
                                );
                            @endphp

                            <div class="pyramid-line">
                                <div class="pyramid-side pyramid-side-left">Женщины</div>
                                <div class="pyramid-middle">Группа</div>
                                <div class="pyramid-side pyramid-side-right">Мужчины</div>
                            </div>

                            @foreach ($groupedData as $groupTitle => $genders)
                                <div class="pyramid-line">
                                    <div class="pyramid-side pyramid-side-left">
                                        <div class="fond_bar" style="width: 100%">
                                            <div class="bar"
                                                style="width: {{ ($genders['female'] / $maxCount) * 100 }}%"></div>
                                        </div>
                                        <div class="pyramid-value left">{{ $genders['female'] }}</div>
                                    </div>
                                    <div class="pyramid-middle">{{ $groupTitle }}</div>
                                    <div class="pyramid-side pyramid-side-right">
                                        <div class="fond_bar" style="width: 100%">
                                            <div class="bar"
                                                style="width: {{ ($genders['male'] / $maxCount) * 100 }}%"></div>
                                        </div>
                                        <div class="pyramid-value right">{{ $genders['male'] }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-4 col-md-6 h-100">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Платформы</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <div id="platform-pie-chart" class="mt-3">
                                @php
                                    $androidCount = $platformData->where('platform', 'android')->count();
                                    $iosCount = $platformData->where('platform', 'ios')->count();
                                    $totalCount = $androidCount + $iosCount;

                                    $androidPercentage = ($androidCount / $totalCount) * 100;
                                    $iosPercentage = ($iosCount / $totalCount) * 100;

                                    $androidAngle = ($androidPercentage / 100) * 360;
                                    $iosAngle = ($iosPercentage / 100) * 360;
                                @endphp

                                <div class="piechart"
                                    style="background-image: conic-gradient(
                                    var(--android-color) 0 {{ $androidAngle }}deg,
                                    var(--ios-color) 0 {{ $iosAngle }}deg
                                );">
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="pie-chart-legend">
                                <div><span class="legend-color android"></span> Android: {{ $androidCount }} -
                                    {{ number_format($androidPercentage, 2) }}%</div>
                                <div><span class="legend-color ios"></span> iOS: {{ $iosCount }} -
                                    {{ number_format($iosPercentage, 2) }}%</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <style>
        :root {
            --left-color: #e74c3c;
            --right-color: #3498db;
            --android-color: #3ddc84;
            --ios-color: #190a4f;
        }

        .diagram-container {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            width: 100%;
        }

        .pyramid-line {
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin: auto;
        }

        .pyramid-middle {
            font-weight: 500;
            flex: 1;
            min-width: 70px;
            text-align: center;
            white-space: nowrap;
        }

        .pyramid-side {
            flex: 3;
            margin: 0px 10px;
            text-align: center;
            display: flex;
            align-items: center;
        }

        .pyramid-side-left {
            color: var(--left-color);
            flex-direction: row-reverse;
        }

        .pyramid-side-right {
            color: var(--right-color);
            flex-direction: row;
        }

        .fond_bar {
            background-color: #f3f3f382;
            height: 15px;
            border-radius: 1000px;
            width: 100%;
            position: relative;
        }

        .bar {
            border-radius: 1000px;
            height: 15px;
            position: absolute;
        }

        .pyramid-side-left .bar {
            background-color: var(--left-color);
            right: 0;
        }

        .pyramid-side-right .bar {
            background-color: var(--right-color);
            left: 0;
        }

        .pyramid-value {
            font-size: 12px;
            padding: 0px 5px;
            flex: 1;
        }

        .left {
            text-align: start;
        }

        .right {
            text-align: end;
        }

        .piechart {
            width: 150px;
            height: 150px;
            border-radius: 50%;
        }

        .pie-chart-legend {
            margin-top: 20px;
        }

        .legend-color {
            display: inline-block;
            width: 20px;
            height: 20px;
            border-radius: 25%;
            margin-right: 10px;
        }

        .legend-color.android {
            background-color: var(--android-color);
        }

        .legend-color.ios {
            background-color: var(--ios-color);
        }
    </style>
</div>
