@extends('frontend.layouts.master')

@section('content')

    <!--Main menu-->
    <div class="menu">
        <div class="container">
            <div class="row">
                <div class="menu__wrapper d-none d-lg-block col-md-12">
                    <nav class="">
                        <ul>
                            <li><a href="#hello">Hello</a></li>
                            <li><a href="#resume">Resume</a></li>
                            <li><a href="#skills">Skills</a></li>
                            <li><a href="#portfolio">Portfolio</a></li>
                            <li><a href="#contact">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="menu__wrapper col-md-12 d-lg-none">
                    <button type="button" class="menu__mobile-button">
                        <span><i class="fa fa-bars" aria-hidden="true"></i></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!--Main menu-->

    <!-- Mobile menu -->
    <div class="mobile-menu d-lg-none">
        <div class="container">
            <div class="mobile-menu__close">
                <span><i class="mdi mdi-close" aria-hidden="true"></i></span>
            </div>
            <nav class="mobile-menu__wrapper">
                <ul>
                    <li><a href="#hello">Hello</a></li>
                    <li><a href="#resume">Resume</a></li>
                    <li><a href="#portfolio">Portfolio</a></li>
                    <li><a href="#testimonials">testimonials</a></li>
                    <li><a href="#blog">blog</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <!-- Mobile menu -->

    <!--Header-->
    <header class="main-header">
        <div class="container">
            <div class="row personal-profile">
                <div class="col-md-4 personal-profile__avatar">
                    <img class="profile_image" src="{{ getImage($user->profile_image) }}" loading="lazy"
                         alt="best web developer portfolio">
                </div>
                <div class="col-md-8">
                    <p class="personal-profile__name">{{ $user->name }}_</p>
                    <p class="personal-profile__work">{{ $user->designation }}</p>
                    <div class="personal-profile__contacts">
                        <dl class="contact-list contact-list__opacity-titles">

                            @if($user->phone)
                                <dt>Phone:</dt>
                                <dd><a href="tel:{{ $user->phone }}">{{ $user->phone }}</a></dd>
                            @endif
                            @if($user->email)
                                <dt>Email:</dt>
                                <dd><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></dd>
                            @endif
                            @if($user->address)
                                <dt>Address:</dt>
                                <dd>{{ $user->address }}</dd>
                            @endif
                            @if($user->quote)
                                <dt>Quote:</dt>
                                <dd>{{ $user->quote }}</dd>
                            @endif

                        </dl>
                    </div>
                    <p class="personal-profile__social">

                        @if($user->social_medias)
                            @forelse(json_decode($user->social_medias, true) as $key => $social_media)
                                @continue($key == 'show_social_media_section')
                                <a href="{{ $social_media['value'] }}" target="_blank">{!! $social_media['icon'] !!}</a>
                            @empty

                            @endforelse
                        @endif

                    </p>
                </div>
            </div>
        </div>
    </header>
    <!--Header-->

    <!--Hello-->
    <section id="hello" class="container section">
        <div class="row">
            <div class="col-md-10">
                <h2 id="hello_header" class="section__title">Hi_</h2>

                @if($user->about)
                    @forelse(json_decode($user->about) as $about)
                        <p class="section__description">
                            {{ $about->value }}
                        </p>
                    @empty
                    @endforelse
                @endif

                @if($user->cv_file)
                    @if (str_contains($user->cv_file, 'http'))
                        <a href="{{ $user->cv_file }}" class="section_btn site-btn" target="_blank">
                            <img src="{{ asset('frontend/img/img_btn_icon.png') }}" alt="Abdullah Al Mamun">
                            Download CV
                        </a>
                    @else
                        <a href="{{ downloadableLink($user->cv_file) }}" class="section_btn site-btn">
                            <img src="{{ asset('frontend/img/img_btn_icon.png') }}" alt="Abdullah Al Mamun">
                            Download CV
                        </a>
                    @endif
                @endif
            </div>
        </div>
    </section>
    <!--Hello-->

    <hr>

    <!--Experience-->
    <section id="resume" class="container section">
        <div class="row">
            <div class="col-md-10">
                <h2 id="resume_header"
                    class="section__title mb-1">{{ json_decode($user->experience_info)->heading ?? 'Resume' }}_</h2>
                <h6>{{ json_decode($user->experience_info)->subheading ?? '' }}</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 section__resume resume-list">
                <h3 class="resume-list_title">Employment</h3>

                @forelse($experiences as $experience)
                    <div class="resume-list__block">
                        <p class="resume-list__block-title">
                            @if($experience->company_url)
                                <a href="{{ $experience->company_url }}"
                                   target="_blank">{{ $experience->company_name }}</a>
                            @else
                                {{ $experience->company_name }}
                            @endif
                        </p>
                        <p>{{ $experience->designation }}</p>
                        <p class="resume-list__block-date">
                            {{ \Carbon\Carbon::parse($experience->from_date)->format('M/Y') }} -
                            {{ $experience->to_date ? \Carbon\Carbon::parse($experience->to_date)->format('M/Y') : 'Present' }}</p>
                        @if($experience->details)
                            @php
                                $details = explode(PHP_EOL, $experience->details);
                            @endphp
                            <div>
                                @foreach($details as $detail)
                                    <p>{!! $detail !!}</p>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @empty
                @endforelse

            </div>
        </div>

        <!--Education-->
        @if(json_decode($user->educations)?->show_education_section ?? 0)
            <div class="row">
                <div class="col-md-8 section__resume resume-list">
                    <h3 class="resume-list_title">education</h3>

                    @php
                        $educations = str_replace('"show_education_section":"1",', '', str_replace('"show_education_section":"0",','',$user->educations));
                    @endphp
                    @foreach(json_decode($educations, 1) as $education)
                        <div class="resume-list__block">
                            <p class="resume-list__block-title">{{ $education['name'] ?? '' }}</p>
                            <p class="resume-list__block-date">{{ $education['years'] ?? '' }}</p>
                            <p>{{ $education['degree'] ?? '' }}</p>
                        </div>
                    @endforeach

                </div>
            </div>
        @endif
        <!--Education-->
    </section>
    <!--Resume-->

    <!--Skills-->
    <section id="skills" class="container section">
        <div class="row">
            <div class="col-md-10">
                <h2 id="resume_header"
                    class="section__title mb-1">{{ json_decode($user->skill_info)->heading ?? 'Professional Skills' }}
                    _</h2>
                <h6>{{ json_decode($user->skill_info)->subheading ?? '' }}</h6>
            </div>
        </div>

        <div class="row section__resume progress-list js-progress-list">

            @forelse($skills as $skill)
                <div class="col-md-5 mr-auto">
                    <h3 class="progress-list__title mb-3">{{ $skill->name }}</h3>

                    <table class="table table-borderless table-sm">
                        <tbody class="small">
                        @forelse($skill->childs as $child)
                            <tr>
                                <th scope="row" class="align-middle border-0">{{ $child->name }}</th>
                                <td class="align-middle border-0">
                                    <ul class="tags">
                                        @forelse($child->childs as $grandChild)
                                            <li>{{ $grandChild->name }}</li>
                                        @empty
                                        @endforelse
                                    </ul>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                        </tbody>
                    </table>

                </div>
            @empty
                No Skill
            @endforelse

        </div>
    </section>
    <!--Skills-->

    <!--Portfolio-->
    <section id="portfolio" class="container section">
        <div class="row">
            <div class="col-md-12">
                <h2 id="portfolio_header"
                    class="section__title">{{ json_decode($user->portfolio_info)->heading ?? 'My Portfolio' }}_</h2>
                <h6>{{ json_decode($user->portfolio_info)->subheading ?? '' }}</h6>
            </div>
        </div>
        {{--        <div class="row portfolio-menu">--}}
        {{--            <div class="col-md-12">--}}
        {{--                <nav>--}}
        {{--                    <ul>--}}
        {{--                        <li><a href="" data-portfolio-target-tag="all">all</a></li>--}}
        {{--                        <li><a href="" data-portfolio-target-tag="mobile apps">mobile apps</a></li>--}}
        {{--                        <li><a href="" data-portfolio-target-tag="web-sites">web-sites</a></li>--}}
        {{--                        <li><a href="" data-portfolio-target-tag="landing-pages">landing pages</a></li>--}}
        {{--                    </ul>--}}
        {{--                </nav>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        <div class="portfolio-cards" x-data="{project: ''}">

            @forelse($projects as $project)
                <div x-on:click="project = {{ $project }}" class="row project-card" data-toggle="modal"
                     data-target="{{ $project->details ? '#portfolioModal' : '' }}" data-portfolio-tag="web-sites">
                    <div class="col-md-6 col-lg-5 project-card__img">
                        <img src="{{ getImage(json_decode($project->images)[0]) }}" alt="{{ $project->name }}">
                    </div>
                    <div class="col-md-6 col-lg-7 project-card__info">
                        <h3 class="project-card__title">{{ $project->name }}</h3>
                        @if(strlen($project->details) < 300)
                            <p class="project-card__description">{{ nl2br($project->details) }}</p>
                        @endif
                        <p class="project-card__stack">Used stack:</p>
                        <ul class="tags">
                            @forelse(explode(',', $project->tags) as $tag)
                                <li>{{ trim($tag) }}</li>
                            @empty
                            @endforelse
                        </ul>
                        @if($project->git)
                            @if (str_contains($project->git, 'github'))
                                <a href="{{ $project->git }}" class="project-card__link" target="_blank"><i
                                        class="fa fa-github"></i> GitHub</a>
                            @elseif(str_contains($project->git, 'gitlab'))
                                <a href="{{ $project->git }}" class="project-card__link" target="_blank"><i
                                        class="fa fa-gitlab"></i> GitLab</a>
                            @endif
                        @endif
                        @if($project->url)
                            <a href="{{ $project->url }}" class="project-card__link mx-1" target="_blank"><i
                                    class="fa fa-globe"></i> Live</a>
                        @endif
                    </div>
                </div>
            @empty
            @endforelse

            <!-- Portfolio Modal -->
            <div class="modal fade portfolio-modal" id="portfolioModal" tabindex="-1" role="dialog"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body col-md-11 col-lg-9 ml-auto mr-auto">
                            <p class="portfolio-modal__title" x-text="project.name"></p>
                            <template x-if="project">
                                <img class="portfolio-modal__img"
                                     x-bind:src="'/storage/'+JSON.parse(project?.images)[0]"
                                     alt="Senior software engineer portfolio">
                            </template>

                            <template x-for="detail in project?.details?.split(/\r?\n/)">
                                <p class="portfolio-modal__description" x-text="detail"></p>
                            </template>


                            <div class="portfolio-modal__link">

                                <template x-if="project.git && project.git.includes('github')">
                                    <a x-bind:href="project.git" target="_blank"><i
                                            class="fa fa-github"></i> GitHub</a>
                                </template>
                                <template x-if="project.git && project.git.includes('gitlab')">
                                    <a x-bind:href="project.git" target="_blank"><i
                                            class="fa fa-gitlab"></i> GitHub</a>
                                </template>
                                <template x-if="project.url">
                                    <a x-bind:href="project.url" target="_blank"><i
                                            class="fa fa-globe"></i> Live</a>
                                </template>
                            </div>
                            <div class="portfolio-modal__stack">
                                <p class="portfolio-modal__stack-title">Used stack:</p>
                                <ul class="tags">

                                    <template x-for="tag in project?.tags?.split(',')">
                                        <li x-text="tag"></li>
                                    </template>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Portfolio Modal -->
        </div>
    </section>
    <!--Portfolio-->

    <!--Git-->
    @if(isset(json_decode($user->git_info)->heading))
        <section id="git" class="container section">
            <div class="row">
                <div class="col-md-12">
                    <h2 id="portfolio_header"
                        class="section__title">{{ json_decode($user->git_info)->heading ?? 'My Git' }}_</h2>
                    <h6>{{ json_decode($user->git_info)->subheading ?? '' }}</h6>
                </div>
            </div>
            <div class="portfolio-cards mb-2">
                <a href="https://github.com/mamun724682" target="_blank"><u>GitHub</u></a>
                <div class="calendar">
                    <img src="https://github.githubassets.com/images/spinners/octocat-spinner-128.gif" class="spinner"/>
                    <p class="spinner-text monospace">Crunching <a
                            href="https://github.com/mamun724682">@Mamun724682</a>'s contributions just for you.</p>
                </div>
            </div>
            <div class="portfolio-cards">
                <a href="https://gitlab.com/abdullahalmamun" target="_blank"><u>GitLab</u></a>
                <div class="calendar">
                    {{--                    <img src="{{ asset('frontend/img/gitlab.jpg') }}" class="w-100" alt="Gitlab">--}}
                    <div id="gitlab_contribution_graph"></div>
                </div>
            </div>

        </section>
    @endif
    <!--Git-->

    <!--Contact-->
    <div class="background" style="background-image: url(frontend/img/img_bg_main.jpg)">
        <div id="contact" class="container section">
            <div class="row">
                <div class="col-md-12">
                    <p id="contacts_header" class="section__title">Get in touch_</p>
                </div>
            </div>
            <div class="row contacts">
                <div class="col-md-5 col-lg-4">
                    <div class="contacts__list">
                        <dl class="contact-list">
                            <dt>Phone:</dt>
                            <dd><a href="tel:{{ $user->phone }}">{{ $user->phone }}</a></dd>
                            {{--                            <dt>Skype:</dt>--}}
                            {{--                            <dd><a href="skype:iamivanovivan">iamivanovivan</a></dd>--}}
                            <dt>Email:</dt>
                            <dd><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></dd>
                        </dl>
                    </div>
                    <div class="contacts__social">
                        <ul>

                            @if($user->social_medias)
                                @forelse(json_decode($user->social_medias, true) as $key => $social_media)
                                    @continue($key == 'show_social_media_section')
                                    <li><a href="{{ $social_media['value'] }}">{{ $social_media['key'] }}</a></li>
                                @empty

                                @endforelse
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-md-7 col-lg-5">
                    <div class="contacts__form">
                        <p class="contacts__form-title">Or just write me a letter here_</p>
                        <form class="js-form">
                            <div class="form-group">
                                <input class="form-field js-field-name" name="name" type="text" placeholder="Your name"
                                       required>
                                <span class="form-validation"></span>
                                <span class="form-invalid-icon"><i class="mdi mdi-close" aria-hidden="true"></i></span>
                            </div>
                            <div class="form-group">
                                <input class="form-field js-field-email" name="email" type="email"
                                       placeholder="Your e-mail"
                                       required>
                                <span class="form-validation"></span>
                                <span class="form-invalid-icon"><i class="mdi mdi-close" aria-hidden="true"></i></span>
                            </div>
                            <div class="form-group">
                            <textarea class="form-field js-field-message" name="message"
                                      placeholder="Type the message here"
                                      required></textarea>
                                <span class="form-validation"></span>
                                <span class="form-invalid-icon"><i class="mdi mdi-close" aria-hidden="true"></i></span>
                            </div>

                            <div class="success_alert"></div>

                            <button class="site-btn site-btn--form" type="submit" value="Send">Send</button>
                        </form>
                    </div>
                    <div class="footer">
                        <p>© {{ date('Y') }} {{ $user->name }}. All Rights Reserved</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Contact-->
@endsection

@push('css')
    <link rel="stylesheet"
          href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <style>
        .profile_image {
            -webkit-filter: grayscale(100%); /* Safari 6.0 - 9.0 */
            filter: grayscale(100%);
        }

        .profile_image:hover {
            -webkit-filter: none; /* Safari 6.0 - 9.0 */
            filter: none;
        }
    </style>

    {{--    Git Calendar--}}
    @if(isset(json_decode($user->git_info)->heading))
        <link rel="stylesheet" href="https://unpkg.com/github-calendar@latest/dist/github-calendar-responsive.css"/>


        <link rel="stylesheet" href="{{ asset('frontend/plugin/contribution_graph/gitlab_contribution_graph.css') }}"/>
    @endif
@endpush

@push('js')
    <script src="//unpkg.com/alpinejs" defer></script>

    {{--    Git Calendar--}}
    @if(isset(json_decode($user->git_info)->heading))
        {{--        Github--}}
        <script src="https://unpkg.com/github-calendar@latest/dist/github-calendar.min.js"></script>
        <script>
            // or enable responsive functionality
            GitHubCalendar(".calendar", "mamun724682", {responsive: true, global_stats: false, tooltips: true});
        </script>

        {{--        Gitlab--}}
        <script src="{{ asset('frontend/plugin/contribution_graph/gitlab_contribution_graph.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#gitlab_contribution_graph').github_graph({
                    //Generate random entries from 50-> 200 entries
                    data: @json($gitlab_contributions),
                    colors: [
                        {count: 0, color: '#dddbdb'},
                        {count: 1, color: '#39dd34'},
                        {count: 3, color: '#45a045'},
                        {count: 7, color: '#047526'},
                        {count: 9, color: '#0a4208'}
                    ],
                    texts: ['contribution', 'contributions'],
                });
            });
        </script>
    @endif
@endpush
