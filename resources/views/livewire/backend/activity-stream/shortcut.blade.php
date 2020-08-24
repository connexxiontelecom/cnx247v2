<div>
    <div class="row mb-4">
        <div class="col-lg-9 col-md-9">

            <div class="col-sm-12">

                <div class="card">
                    <div class="card-block" wire:ignore>

                        <!-- Row start -->
                        <div class="row m-b-30">
                            <div class="col-lg-12 col-xl-12">
                                <span class="float-right toggleTab" style="cursor: pointer;"><i class="zmdi zmdi-swap-vertical text-info"></i></span>
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs md-tabs" role="tablist">
                                    <li class="nav-item expandContent" style="width:120px; padding:5px;">
                                        <a class="nav-link active" data-toggle="tab" href="#message" role="tab">Message</a>
                                        <div class="slide" style="width:120px;"></div>
                                    </li>
                                    <li class="nav-item expandContent" style="width:100px; padding:5px;">
                                        <a class="nav-link" data-toggle="tab" href="#task" role="tab">Task</a>
                                        <div class="slide" style="width:100px;"></div>
                                    </li>
                                    <li class="nav-item expandContent" style="width:120px; padding:5px;">
                                        <a class="nav-link" data-toggle="tab" href="#event" role="tab">Event</a>
                                        <div class="slide" style="width:120px;"></div>
                                    </li>
                                    <li class="nav-item expandContent" style="width:120px; padding:5px;">
                                        <a class="nav-link" data-toggle="tab" href="#announcement" role="tab">Announcement</a>
                                        <div class="slide" style="width:120px;"></div>
                                    </li>
                                    <li class="nav-item expandContent" style="width:120px; padding:5px;">
                                        <a class="nav-link" data-toggle="tab" href="#file" role="tab">File</a>
                                        <div class="slide" style="width:120px; "></div>
                                    </li>
                                    <li class="nav-item expandContent" style="width:120px; padding:5px;">
                                        <a class="nav-link" data-toggle="tab" href="#appreciation" role="tab">Appreciation</a>
                                        <div class="slide" style="width:120px;"></div>
                                    </li>

                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content card-block tabContentArea">
                                    <div class="tab-pane active" id="message" role="tabpanel">

                                        <div class="card-block">
                                            <form>
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <textarea id="compose_message" class="form-control form-control-normal content" placeholder="Compose message" style="resize: none;"></textarea>
                                                        @error('compose_message')
                                                            <i class="text-danger">{{ $message }}</i>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <input type="file" name="message_attachments" id="message_attachments" multiple="multiple">
                                                </div>
                                                <div class=" row mb-4">
                                                    <div class="col-md-6">
                                                        <div class="">
                                                            <input type="checkbox" class="js-small" id="message_all_employees">

                                                                To all employees
                                                        </div>
                                                        <span><strong>OR</strong></span>
                                                        <p>To specific person(s)
                                                        </p>
                                                        <select id="message_persons" class="js-example-responsive col-sm-12" multiple="multiple" style="width:75%;">
                                                            <option selected disabled>Select person(s)</option>
                                                            @foreach ($users as $user)
                                                                <option value="{{ $user->id }}">{{ $user->first_name}} {{ $user->surname ?? '' }}</option>

                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row ">
                                                    <div class="col-md-12 d-flex justify-content-center">
                                                        <button class="btn btn-sm btn-primary" type="button" id="sendMessage"><i class="zmdi zmdi-mail-send mr-2"></i> Send Message</button>
                                                    </div>
                                                    <div class="col-md-12 d-flex justify-content-center mt-1 ">
                                                        <div class="preloader3 loader-block message-cus-preloader">
                                                            <div class="circ1 loader-primary"></div>
                                                            <div class="circ2 loader-primary"></div>
                                                            <div class="circ3 loader-primary"></div>
                                                            <div class="circ4 loader-primary"></div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="task" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-12 btn-add-task">
                                                <form wire:submit.prevent="createTask">
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Task Title</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" id="task_title" class="form-control form-control-normal mb-2" placeholder="Task title">
                                                            @error('task_title')
                                                                <i class="text-danger">{{$message}}</i>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Task Description</label>
                                                        <div class="col-sm-10">
                                                            <textarea id="task_description"  cols="5" rows="5" class="content form-control form-control-normal mb-2" placeholder="Task Description"></textarea>
                                                            @error('task_description')
                                                                <i class="text-danger">{{$message}}</i>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Due Date</label>
                                                        <div class="col-sm-10 col-md-4">
                                                            <input type="datetime-local" id="due_date" class="form-control form-control-normal" placeholder="Due date">
                                                            @error('due_date')
                                                                <i class="text-danger">{{$message}}</i>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Start Date <i>(Optional)</i></label>
                                                        <div class="col-sm-10 col-md-4">
                                                            <input type="datetime-local" id="start_date" class="form-control form-control-normal" placeholder="Task title">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Choose Color <abbr title="Quickly identify this task on task board by assigning a color to it.">?</abbr></label>
                                                        <div class="col-sm-10 col-md-2">
                                                            <input type="color" id="color" class="form-control form-control-normal">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Responsible Person(s)</label>
                                                        <div class="col-sm-10 col-md-4">
                                                            <select id="responsible_persons" class="js-example-basic-multiple col-sm-12" multiple="multiple">
                                                                <option selected disabled>Add Responsible Person(s)</option>
                                                                @foreach($users as $user)
                                                                    <option value="{{$user->id}}">{{$user->first_name ?? ''}} {{$user->surname ?? ''}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Participant(s) <i>(Optional)</i> </label>
                                                        <div class="col-sm-10 col-md-4">
                                                            <select id="participants" class="js-example-basic-multiple col-sm-12" multiple="multiple">
                                                                <option selected disabled>Add participant(s)</option>
                                                                @foreach($users as $user)
                                                                    <option value="{{$user->id}}">{{$user->first_name ?? ''}} {{$user->surname ?? ''}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Observer(s) <i>(Optional)</i> </label>
                                                        <div class="col-sm-10 col-md-4">
                                                            <select id="observers" class="js-example-basic-multiple col-sm-12" multiple="multiple">
                                                                <option selected disabled>Add observer(s)</option>
                                                                @foreach($users as $user)
                                                                    <option value="{{$user->id}}">{{$user->first_name ?? ''}} {{$user->surname ?? ''}}</option>
                                                                @endforeach
                                                            </select>

                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Attachment</label>
                                                        <div class="col-sm-10 col-md-4">
                                                            <input type="file" id="task_attachments" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Priority</label>
                                                        <div class="col-sm-10 col-md-3">
                                                            <select id="priority" class="form-control form-control-normal">
                                                                <option value="1">Highest priority</option>
                                                                <option value="2">High priority</option>
                                                                <option value="3">Normal priority</option>
                                                                <option value="4">Low priority</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Status</label>
                                                        <div class="col-sm-10 col-md-3">
                                                            <select id="status" class="form-control form-control-normal">
                                                                <option value="1">Open</option>
                                                                <option value="2">on Hold</option>
                                                                <option value="3">Resolved</option>
                                                                <option value="4">Closed</option>
                                                                <option value="5">At Risk</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 d-flex justify-content-center">
                                                            <button class="btn btn-primary btn-sm" type="submit" id="submitTask">Submit</button>

                                                        </div>
                                                        <div class="col-md-12 d-flex justify-content-center mt-1 ">
                                                            <div class="preloader3 loader-block task-cus-preloader">
                                                                <div class="circ1 loader-primary"></div>
                                                                <div class="circ2 loader-primary"></div>
                                                                <div class="circ3 loader-primary"></div>
                                                                <div class="circ4 loader-primary"></div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="event" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-12 btn-add-task">
                                                <form wire:submit.prevent="createTask">
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Event Name</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" id="event_name" class="form-control form-control-normal mb-2" placeholder="Event Name">
                                                            @error('event_name')
                                                                <i class="text-danger">{{$message}}</i>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Event Description</label>
                                                        <div class="col-sm-10">
                                                            <textarea id="event_description"  cols="5" rows="5" class="content form-control form-control-normal mb-2" placeholder="Event Description"></textarea>
                                                            @error('event_description')
                                                                <i class="text-danger">{{$message}}</i>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Event Date</label>
                                                        <div class="col-sm-10 col-md-4">
                                                            <input type="datetime-local" id="event_start_date" class="form-control form-control-normal" placeholder="Event Start date">
                                                            @error('event_start_date')
                                                                <i class="text-danger">{{$message}}</i>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Event End Date <i>(Optional)</i></label>
                                                        <div class="col-sm-10 col-md-4">
                                                            <input type="datetime-local" id="event_end_date" class="form-control form-control-normal" placeholder="Event End Date">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Attendee(s)</label>
                                                        <div class="col-sm-10 col-md-4">
                                                            <select id="attendees" class="js-example-basic-multiple col-sm-12" multiple="multiple">
                                                                <option value="{{ Auth::user()->id }} " selected>{{ Auth::user()->first_name }} {{ Auth::user()->surname ?? '' }}</option>
                                                                @foreach($users as $user)
                                                                    <option value="{{$user->id}}">{{$user->first_name ?? ''}} {{$user->surname ?? ''}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 d-flex justify-content-center">
                                                            <button class="btn btn-primary btn-sm" type="submit" id="submitEvent">Submit</button>

                                                        </div>
                                                        <div class="col-md-12 d-flex justify-content-center mt-1 ">
                                                            <div class="preloader3 loader-block event-cus-preloader">
                                                                <div class="circ1 loader-primary"></div>
                                                                <div class="circ2 loader-primary"></div>
                                                                <div class="circ3 loader-primary"></div>
                                                                <div class="circ4 loader-primary"></div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="announcement" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-12 btn-add-task">
                                                <form >
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Subject</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" id="subject" class="form-control form-control-normal mb-2" placeholder="Subject">
                                                            @error('subject')
                                                                <i class="text-danger">{{$message}}</i>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Content</label>
                                                        <div class="col-sm-10">
                                                            <textarea id="announcement_text"  cols="5" rows="5" class="content form-control form-control-normal mb-2" placeholder="Type content here..."></textarea>
                                                            @error('announcement_text')
                                                                <i class="text-danger">{{$message}}</i>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <label class="col-sm-2 col-form-label">Attachment</label>
                                                        <div class="col-sm-10">
                                                            <input type="file" name="announcement_attachment" id="announcement_attachment">
                                                        </div>

                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">To:</label>
                                                        <div class="col-sm-10 col-md-4">
                                                            <select id="announce_to" class="js-example-basic-multiple col-sm-12" multiple="multiple">
                                                                <option value="32 " selected>To all employees</option>
                                                                @foreach($users as $user)
                                                                    <option value="{{$user->id}}">{{$user->first_name ?? ''}} {{$user->surname ?? ''}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 d-flex justify-content-center">
                                                            <button class="btn btn-primary btn-sm" type="submit" id="submitAnnouncement">Submit</button>

                                                        </div>
                                                        <div class="col-md-12 d-flex justify-content-center mt-1 ">
                                                            <div class="preloader3 loader-block announcement-cus-preloader">
                                                                <div class="circ1 loader-primary"></div>
                                                                <div class="circ2 loader-primary"></div>
                                                                <div class="circ3 loader-primary"></div>
                                                                <div class="circ4 loader-primary"></div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="file" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-12 btn-add-task">
                                                <form >
                                                    <div class="row form-group">
                                                        <label class="col-sm-2 col-form-label">Attachment</label>
                                                        <div class="col-sm-10">
                                                            <input type="file" name="shareFile" id="shareFile" multiple>
                                                        </div>

                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Share with:</label>
                                                        <div class="col-sm-10 col-md-4">
                                                            <select id="share_with" class="js-example-basic-multiple col-sm-12" multiple="multiple">
                                                                <option value="32 " selected>To all employees</option>
                                                                @foreach($users as $user)
                                                                    <option value="{{$user->id}}">{{$user->first_name ?? ''}} {{$user->surname ?? ''}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 d-flex justify-content-center">
                                                            <button class="btn btn-primary btn-sm" type="submit" id="uploadFilesBtn">Share File(s)</button>

                                                        </div>
                                                        <div class="col-md-12 d-flex justify-content-center mt-1 ">
                                                            <div class="preloader3 loader-block file-cus-preloader">
                                                                <div class="circ1 loader-primary"></div>
                                                                <div class="circ2 loader-primary"></div>
                                                                <div class="circ3 loader-primary"></div>
                                                                <div class="circ4 loader-primary"></div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="appreciation" role="tabpanel">
                                        <form >
                                            <div class="form-group">
                                                <label class="">Content</label>
                                                    <textarea id="appreciation_text"  cols="5" rows="5" class="content form-control form-control-normal mb-2" placeholder="Type content here..."></textarea>
                                                    @error('appreciation_text')
                                                        <i class="text-danger">{{$message}}</i>
                                                    @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="">Persons:</label>
                                                    <select id="appreciating" class="js-example-basic-multiple col-sm-8 col-md-8" multiple="multiple">
                                                        <option value="32 " selected>To all employees</option>
                                                        @foreach($users as $user)
                                                            <option value="{{$user->id}}">{{$user->first_name ?? ''}} {{$user->surname ?? ''}}</option>
                                                        @endforeach
                                                    </select>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 d-flex justify-content-center">
                                                    <button class="btn btn-primary btn-sm" type="submit" id="submitAppreciation">Submit</button>

                                                </div>
                                                <div class="col-md-12 d-flex justify-content-center mt-1 ">
                                                    <div class="preloader3 loader-block appreciation-cus-preloader">
                                                        <div class="circ1 loader-primary"></div>
                                                        <div class="circ2 loader-primary"></div>
                                                        <div class="circ3 loader-primary"></div>
                                                        <div class="circ4 loader-primary"></div>
                                                    </div>

                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Row end -->
                    </div>
                </div>
                <!-- Material tab card end -->
            </div>
            <div class="tab-pane active" id="timeline" >{{--  wire:poll.5000ms="getContent" --}}
                    <div class="row">
                        <div class="col-md-12 timeline-dot">
                            @foreach($posts as $post)
                                @if($post->post_type == 'message')
                                    @foreach ($post->responsiblePersons as $person)
                                        @if ($person->user_id == Auth::user()->id)
                                            <div class="social-timelines p-relative">
                                                <div class="row timeline-right p-t-35">
                                                    <div class="col-2 col-sm-2 col-xl-1">
                                                        <div class="social-timelines-left">
                                                            <img class="img-radius timeline-icon" src="/assets/images/avatars/thumbnails/{{ $post->user->avatar ?? 'avatar.png' }}" alt="{{Auth::user()->first_name}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-10 col-sm-10 col-xl-11 p-l-5 p-b-35">
                                                        <div class="card">

                                                            <div class="card-block post-timelines">
                                                                <span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>
                                                                <div class="dropdown-menu dropdown-menu-right b-none services-list">
                                                                    <a class="dropdown-item" href="#">Remove tag</a>
                                                                    <a class="dropdown-item" href="#">Report Photo</a>
                                                                    <a class="dropdown-item" href="#">Hide From Timeline</a>
                                                                    <a class="dropdown-item" href="#">Blog User</a>
                                                                </div>
                                                                <div class="chat-header f-w-600">{{$post->user->first_name ?? ''}} {{$post->user->surname ?? ''}} {<i class="zmdi zmdi-email text-inverse mr-1 ml-1"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Message"></i>} <i class="zmdi zmdi-long-arrow-right text-primary"></i>

                                                                    @foreach($post->responsiblePersons as $res)
                                                                            <small>{{ $res->user->first_name}} {{ $res->user->surname}}</small>,
                                                                    @endforeach

                                                                </div>
                                                                <div class="social-time text-muted">{{$post->created_at->diffForHumans()}}</div>
                                                            </div>
                                                            <div class="card-block">

                                                                <div class="timeline-details">
                                                                    <p class="text-muted">{!! $post->post_content ?? '' !!}</p>
                                                                    @foreach ($post->postAttachment as $attach)
                                                                        <a href="{{$attach->attachment}}">{{ $post->post_title ?? 'Download attachment'}}</a>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            <div class="card-block b-b-theme b-t-theme social-msg">

                                                                @if(!empty($post->postLikes()->where('user_id', Auth::user()->id)->first()))
                                                                    <a href="#" wire:click="unLike({{ $post->id }})"> <i class="icofont icofont-thumbs-down text-danger" ></i>
                                                                        <span class="b-r-muted">Unlike ({{ count($post->postLikes) }}) </span>
                                                                    </a>

                                                                @elseif(empty($post->postLikes()->where('user_id', Auth::user()->id)->first()))
                                                                    <a href="#" wire:click="addLike({{ $post->id }})"> <i class="icofont icofont-like text-success" ></i>
                                                                        <span class="b-r-muted">Like ({{ count($post->postLikes) }}) </span>
                                                                    </a>
                                                                @endif
                                                                <a href="#"> <i class="icofont icofont-comment text-muted"></i> <span class="b-r-muted">Comments ({{ count($post->postComments) }})</span></a>
                                                                <a href="#"> <i class="ti-eye text-muted"></i> <span>View (10)</span></a>
                                                            </div>
                                                            <div class="card-block user-box">
                                                                <div class="p-b-30"> <span class="f-14"><a href="javascript:void(0);">Comments ({{ count($post->postComments) }})</a></span>
                                                                </div>
                                                                @foreach($post->postComments as $comment)
                                                                    <div class="media m-b-20">
                                                                        <a class="media-left" href="{{ route('view-profile', $comment->user->url) }}">
                                                                            <img class="media-object img-radius m-r-20" src="{{ $comment->user->avatar ?? '/assets/images/avatar-1.jpg' }}" alt="{{ $comment->user->first_name }} {{ $comment->user->surname ?? '' }}">
                                                                        </a>
                                                                        <div class="media-body b-b-muted social-client-description">
                                                                            <div class="chat-header"><a href="{{ route('view-profile', $comment->user->url) }}">{{ $comment->user->first_name }} {{ $comment->user->surname ?? '' }} </a> <span class="text-muted">{{date('d M, Y', strtotime($comment->created_at)) }} <small>({{ $comment->created_at->diffForHumans() }})</small></span></div>
                                                                            <p class="text-muted"> {!! $comment->comment !!} </p>
                                                                        </div>
                                                                    </div>
                                                                @endforeach

                                                                <div class="media">
                                                                    <a class="media-left" href="{{ route('view-profile', Auth::user()->url) }}">
                                                                <img class="media-object img-radius m-r-20" src="{{ Auth::user()->avatar ?? '/assets/images/user.png' }}" alt="Generic placeholder image">
                                                            </a>
                                                                <div class="media-body">

                                                                    <div class="">
                                                                        <textarea wire:model.debounce.50000ms="comment" rows="5" cols="5" class="form-control" placeholder="Leave comment"></textarea>

                                                                        <div class="text-right m-t-20">
                                                                            <button class="btn btn-out-dashed btn-primary btn-square btn-sm" type="button" wire:click="comment({{ $post->id }})">Comment</button>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        @endif
                                    @endforeach
                                @elseif($post->post_type == 'task')
                                    @foreach ($post->responsiblePersons as $res)
                                        @if ($res->user_id == Auth::user()->id)

                                            <div class="social-timelines p-relative">
                                                <div class="row timeline-right p-t-35">
                                                    <div class="col-2 col-sm-2 col-xl-1">
                                                        <div class="social-timelines-left">
                                                            <img class="img-radius timeline-icon" src="{{ $post->user->avatar ?? '/assets/images/avatar-2.jpg' }}" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="col-10 col-sm-10 col-xl-11 p-l-5 p-b-35">
                                                        <div class="card">

                                                            <div class="card-block post-timelines">
                                                                <span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>
                                                                <div class="dropdown-menu dropdown-menu-right b-none services-list">
                                                                    <a class="dropdown-item" href="#">Remove tag</a>
                                                                    <a class="dropdown-item" href="#">Report Photo</a>
                                                                    <a class="dropdown-item" href="#">Hide From Timeline</a>
                                                                    <a class="dropdown-item" href="#">Blog User</a>
                                                                </div>
                                                                <div class="chat-header f-w-600">{{$post->user->first_name ?? ''}} {{$post->user->surname ?? ''}} {<i class="ti-check-box text-inverse mr-1 ml-1"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Task"></i>} <i class="zmdi zmdi-long-arrow-right text-primary"></i>

                                                                    @foreach($post->responsiblePersons as $res)
                                                                            <small>{{ $res->user->first_name}} {{ $res->user->surname}}</small>,
                                                                    @endforeach

                                                                </div>
                                                                <div class="social-time text-muted">{{$post->created_at->diffForHumans()}}</div>
                                                            </div>
                                                            <div class="card-block">

                                                                <div class="timeline-details">
                                                                    <p class="text-muted">{!! $post->post_content ?? '' !!}</p>
                                                                    @foreach ($post->postAttachment as $attach)
                                                                        <a href="{{$attach->attachment}}">{{ $post->post_title ?? 'Download attachment'}}</a>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            <div class="card-block b-b-theme b-t-theme social-msg">
                                                                @if(!empty($post->postLikes()->where('user_id', Auth::user()->id)->first()))
                                                                    <a href="#" wire:click="unLike({{ $post->id }})"> <i class="icofont icofont-thumbs-down text-danger" ></i>
                                                                        <span class="b-r-muted">Unlike ({{ count($post->postLikes) }}) </span>
                                                                    </a>

                                                                @elseif(empty($post->postLikes()->where('user_id', Auth::user()->id)->first()))
                                                                    <a href="#" wire:click="addLike({{ $post->id }})"> <i class="icofont icofont-like text-success" ></i>
                                                                        <span class="b-r-muted">Like ({{ count($post->postLikes) }}) </span>
                                                                    </a>
                                                                @endif
                                                                <a href="#"> <i class="icofont icofont-comment text-muted"></i> <span class="b-r-muted">Comments ({{ count($post->postComments) }})</span></a>
                                                                <a href="#"> <i class="ti-eye text-muted"></i> <span>View (10)</span></a>
                                                            </div>
                                                            <div class="card-block user-box">
                                                                <div class="p-b-30"> <span class="f-14"><a href="#">Comments ({{ count($post->postComments) }})</a></span>

                                                                </div>

                                                                @foreach($post->postComments as $comment)
                                                                    <div class="media m-b-20">
                                                                        <a class="media-left" href="{{ route('view-profile', $comment->user->url) }}">
                                                                            <img class="media-object img-radius m-r-20" src="{{ $comment->user->avatar ?? '/assets/images/avatar-1.jpg' }}" alt="{{ $comment->user->first_name }} {{ $comment->user->surname ?? '' }}">
                                                                        </a>
                                                                        <div class="media-body b-b-muted social-client-description">
                                                                            <div class="chat-header"> <a href="{{ route('view-profile', $comment->user->url) }}"> {{ $comment->user->first_name }} {{ $comment->user->surname ?? '' }} </a> <span class="text-muted">{{date('d M, Y', strtotime($comment->created_at)) }} <small>({{ $comment->created_at->diffForHumans() }})</small></span></div>
                                                                            <p class="text-muted"> {!! $comment->comment !!} </p>
                                                                        </div>
                                                                    </div>
                                                                @endforeach

                                                                <div class="media">
                                                                    <a class="media-left" href="{{ route('view-profile', Auth::user()->url) }}">
                                                                        <img class="media-object img-radius m-r-20" src="{{ Auth::user()->avatar ?? '/assets/images/user.png' }}" alt="Generic placeholder image">
                                                                    </a>
                                                                    <div class="media-body">

                                                                        <div class="">
                                                                            <textarea wire:model.debounce.50000ms="comment" rows="5" cols="5" class="form-control" placeholder="Leave comment"></textarea>

                                                                            <div class="text-right m-t-20">
                                                                                <button class="btn btn-out-dashed btn-primary btn-square btn-sm" type="button" wire:click="comment({{ $post->id }})">Comment</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach

                                @elseif($post->post_type == 'event')
                                        @foreach ($post->responsiblePersons as $res)
                                            @if ($res->user_id == Auth::user()->id)

                                                <div class="social-timelines p-relative">
                                                    <div class="row timeline-right p-t-35">
                                                        <div class="col-2 col-sm-2 col-xl-1">
                                                            <div class="social-timelines-left">
                                                                <img class="img-radius timeline-icon" src="/assets/images/avatars/thumbnails/{{ $post->user->avatar ?? 'avatar.png' }}" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="col-10 col-sm-10 col-xl-11 p-l-5 p-b-35">
                                                            <div class="card">

                                                                <div class="card-block post-timelines">
                                                                    <span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>
                                                                    <div class="dropdown-menu dropdown-menu-right b-none services-list">
                                                                        <a class="dropdown-item" href="#">Remove tag</a>
                                                                        <a class="dropdown-item" href="#">Report Photo</a>
                                                                        <a class="dropdown-item" href="#">Hide From Timeline</a>
                                                                        <a class="dropdown-item" href="#">Blog User</a>
                                                                    </div>
                                                                    <div class="chat-header f-w-600">{{$post->user->first_name ?? ''}} {{$post->user->surname ?? ''}} {<i class="ti-calendar text-inverse mr-1 ml-1"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Event"></i>} <i class="zmdi zmdi-long-arrow-right text-primary"></i>

                                                                        @foreach($post->responsiblePersons as $res)
                                                                                <small>{{ $res->user->first_name}} {{ $res->user->surname}}</small>,
                                                                        @endforeach

                                                                    </div>
                                                                    <div class="social-time text-muted">{{date('d F, Y', strtotime($post->created_at))}} | <small>{{ $post->created_at->diffForHumans()}}</small> </div>
                                                                </div>
                                                                <div class="card-block">

                                                                    <div class="timeline-details">
                                                                        <h5>{{ $post->post_title ?? '' }}</h5>
                                                                        <p class="text-muted">{!! $post->post_content ?? '' !!}</p>
                                                                        <div>
                                                                            <p><strong>Start Date: </strong> {{ date('d F, Y', strtotime($post->start_date)) ?? '' }}</p>
                                                                            <p><strong>End Date: </strong> {{ date('d F, Y', strtotime($post->end_date)) ?? '' }}</p>
                                                                        </div>
                                                                        @foreach ($post->postAttachment as $attach)
                                                                            <a href="{{$attach->attachment}}">{{ $post->post_title ?? 'Download attachment'}}</a>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                                <div class="card-block b-b-theme b-t-theme social-msg">
                                                                    @if(!empty($post->postLikes()->where('user_id', Auth::user()->id)->first()))
                                                                        <a href="#" wire:click="unLike({{ $post->id }})"> <i class="icofont icofont-thumbs-down text-danger" ></i>
                                                                            <span class="b-r-muted">Unlike ({{ count($post->postLikes) }}) </span>
                                                                        </a>

                                                                    @elseif(empty($post->postLikes()->where('user_id', Auth::user()->id)->first()))
                                                                        <a href="#" wire:click="addLike({{ $post->id }})"> <i class="icofont icofont-like text-success" ></i>
                                                                            <span class="b-r-muted">Like ({{ count($post->postLikes) }}) </span>
                                                                        </a>
                                                                    @endif
                                                                    <a href="#"> <i class="icofont icofont-comment text-muted"></i> <span class="b-r-muted">Comments ({{ count($post->postComments) }})</span></a>
                                                                    <a href="#"> <i class="ti-eye text-muted"></i> <span>View (10)</span></a>
                                                                </div>
                                                                <div class="card-block user-box">
                                                                    <div class="p-b-30"> <span class="f-14"><a href="#">Comments ({{ count($post->postComments) }})</a></span>

                                                                    </div>

                                                                    @foreach($post->postComments as $comment)
                                                                        <div class="media m-b-20">
                                                                            <a class="media-left" href="{{ route('view-profile', $comment->user->url) }}">
                                                                                <img class="media-object img-radius m-r-20" src="/assets/images/avatars/thumbnails/{{ $comment->user->avatar ?? 'avatar.png' }}" alt="{{ $comment->user->first_name }} {{ $comment->user->surname ?? '' }}">
                                                                            </a>
                                                                            <div class="media-body b-b-muted social-client-description">
                                                                                <div class="chat-header"> <a href="{{ route('view-profile', $comment->user->url) }}"> {{ $comment->user->first_name }} {{ $comment->user->surname ?? '' }} </a> <span class="text-muted">{{date('d M, Y', strtotime($comment->created_at)) }} <small>({{ $comment->created_at->diffForHumans() }})</small></span></div>
                                                                                <p class="text-muted"> {!! $comment->comment !!} </p>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach

                                                                    <div class="media">
                                                                        <a class="media-left" href="{{ route('view-profile', Auth::user()->url) }}">
                                                                            <img class="media-object img-radius m-r-20" src="/assets/images/avatars/thumbnails/avatar.png" alt="Generic placeholder image">
                                                                        </a>
                                                                        <div class="media-body">

                                                                            <div class="">
                                                                                <textarea wire:model.debounce.50000ms="comment" rows="5" cols="5" class="form-control" placeholder="Leave comment"></textarea>

                                                                                <div class="text-right m-t-20">
                                                                                    <button class="btn btn-out-dashed btn-primary btn-square btn-sm" type="button" wire:click="comment({{ $post->id }})">Comment</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                @elseif($post->post_type == 'announcement')
                                        @foreach ($post->responsiblePersons as $res)
                                            @if ($res->user_id == Auth::user()->id)

                                                <div class="social-timelines p-relative">
                                                    <div class="row timeline-right p-t-35">
                                                        <div class="col-2 col-sm-2 col-xl-1">
                                                            <div class="social-timelines-left">
                                                                <img class="img-radius timeline-icon" src="{{ $post->user->avatar ?? '/assets/images/avatar-2.jpg' }}" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="col-10 col-sm-10 col-xl-11 p-l-5 p-b-35">
                                                            <div class="card">

                                                                <div class="card-block post-timelines">
                                                                    <span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>
                                                                    <div class="dropdown-menu dropdown-menu-right b-none services-list">
                                                                        <a class="dropdown-item" href="#">Remove tag</a>
                                                                        <a class="dropdown-item" href="#">Report Photo</a>
                                                                        <a class="dropdown-item" href="#">Hide From Timeline</a>
                                                                        <a class="dropdown-item" href="#">Blog User</a>
                                                                    </div>
                                                                    <div class="chat-header f-w-600">{{$post->user->first_name ?? ''}} {{$post->user->surname ?? ''}} {<i class="ti-announcement text-inverse mr-1 ml-1"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Announcement"></i>} <i class="zmdi zmdi-long-arrow-right text-primary"></i>

                                                                        @foreach($post->responsiblePersons as $res)
                                                                                <small>{{ $res->user->first_name}} {{ $res->user->surname}}</small>,
                                                                        @endforeach

                                                                    </div>
                                                                    <div class="social-time text-muted">{{date('d F, Y', strtotime($post->created_at))}} | <small>{{ $post->created_at->diffForHumans()}}</small> </div>
                                                                </div>
                                                                <div class="card-block">

                                                                    <div class="timeline-details">
                                                                        <h5>{{ $post->post_title ?? '' }}</h5>
                                                                        <p class="text-muted">{!! $post->post_content ?? '' !!} yes</p>
                                                                        @foreach ($post->postAttachment as $attach)
                                                                            <a href="{{$attach->attachment}}">{{ $post->post_title ?? 'Download attachment'}}</a>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                                <div class="card-block b-b-theme b-t-theme social-msg">
                                                                    @if(!empty($post->postLikes()->where('user_id', Auth::user()->id)->first()))
                                                                        <a href="#" wire:click="unLike({{ $post->id }})"> <i class="icofont icofont-thumbs-down text-danger" ></i>
                                                                            <span class="b-r-muted">Unlike ({{ count($post->postLikes) }}) </span>
                                                                        </a>

                                                                    @elseif(empty($post->postLikes()->where('user_id', Auth::user()->id)->first()))
                                                                        <a href="#" wire:click="addLike({{ $post->id }})"> <i class="icofont icofont-like text-success" ></i>
                                                                            <span class="b-r-muted">Like ({{ count($post->postLikes) }}) </span>
                                                                        </a>
                                                                    @endif
                                                                    <a href="#"> <i class="icofont icofont-comment text-muted"></i> <span class="b-r-muted">Comments ({{ count($post->postComments) }})</span></a>
                                                                    <a href="#"> <i class="ti-eye text-muted"></i> <span>View (10)</span></a>
                                                                </div>
                                                                <div class="card-block user-box">
                                                                    <div class="p-b-30"> <span class="f-14"><a href="#">Comments ({{ count($post->postComments) }})</a></span>

                                                                    </div>

                                                                    @foreach($post->postComments as $comment)
                                                                        <div class="media m-b-20">
                                                                            <a class="media-left" href="{{ route('view-profile', $comment->user->url) }}">
                                                                                <img class="media-object img-radius m-r-20" src="{{ $comment->user->avatar ?? '/assets/images/avatar-1.jpg' }}" alt="{{ $comment->user->first_name }} {{ $comment->user->surname ?? '' }}">
                                                                            </a>
                                                                            <div class="media-body b-b-muted social-client-description">
                                                                                <div class="chat-header"> <a href="{{ route('view-profile', $comment->user->url) }}"> {{ $comment->user->first_name }} {{ $comment->user->surname ?? '' }} </a> <span class="text-muted">{{date('d M, Y', strtotime($comment->created_at)) }} <small>({{ $comment->created_at->diffForHumans() }})</small></span></div>
                                                                                <p class="text-muted"> {!! $comment->comment !!} </p>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach

                                                                    <div class="media">
                                                                        <a class="media-left" href="{{ route('view-profile', Auth::user()->url) }}">
                                                                            <img class="media-object img-radius m-r-20" src="{{ Auth::user()->avatar ?? '/assets/images/user.png' }}" alt="Generic placeholder image">
                                                                        </a>
                                                                        <div class="media-body">

                                                                            <div class="">
                                                                                <textarea wire:model.debounce.50000ms="comment" rows="5" cols="5" class="form-control" placeholder="Leave comment"></textarea>

                                                                                <div class="text-right m-t-20">
                                                                                    <button class="btn btn-out-dashed btn-primary btn-square btn-sm" type="button" wire:click="comment({{ $post->id }})">Comment</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                @elseif($post->post_type == 'appreciation')
                                        @foreach ($post->responsiblePersons as $res)
                                        @if ($res->user_id == Auth::user()->id)

                                            <div class="social-timelines p-relative">
                                                <div class="row timeline-right p-t-35">
                                                    <div class="col-2 col-sm-2 col-xl-1">
                                                        <div class="social-timelines-left">
                                                            <img class="img-radius timeline-icon" src="{{ $post->user->avatar ?? '/assets/images/avatar-2.jpg' }}" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="col-10 col-sm-10 col-xl-11 p-l-5 p-b-35">
                                                        <div class="card">

                                                            <div class="card-block post-timelines">
                                                                <span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>
                                                                <div class="dropdown-menu dropdown-menu-right b-none services-list">
                                                                    <a class="dropdown-item" href="#">Remove tag</a>
                                                                    <a class="dropdown-item" href="#">Report Photo</a>
                                                                    <a class="dropdown-item" href="#">Hide From Timeline</a>
                                                                    <a class="dropdown-item" href="#">Blog User</a>
                                                                </div>
                                                                <div class="chat-header f-w-600">{{$post->user->first_name ?? ''}} {{$post->user->surname ?? ''}} {<i class="ti-gift text-inverse mr-1 ml-1"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Appreciation"></i>} <i class="zmdi zmdi-long-arrow-right text-primary"></i>

                                                                    @foreach($post->responsiblePersons as $res)
                                                                            <small>{{ $res->user->first_name}} {{ $res->user->surname}}</small>,
                                                                    @endforeach

                                                                </div>
                                                                <div class="social-time text-muted">{{date('d F, Y', strtotime($post->created_at))}} | <small>{{ $post->created_at->diffForHumans()}}</small> </div>
                                                            </div>
                                                            <div class="card-block">

                                                                <div class="timeline-details">
                                                                    <h5>{{ $post->post_title ?? '' }}</h5>
                                                                    <p class="text-muted">{!! $post->post_content ?? '' !!}</p>
                                                                    @foreach ($post->postAttachment as $attach)
                                                                        <a href="{{$attach->attachment}}">{{ $post->post_title ?? 'Download attachment'}}</a>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            <div class="card-block b-b-theme b-t-theme social-msg">
                                                                @if(!empty($post->postLikes()->where('user_id', Auth::user()->id)->first()))
                                                                    <a href="#" wire:click="unLike({{ $post->id }})"> <i class="icofont icofont-thumbs-down text-danger" ></i>
                                                                        <span class="b-r-muted">Unlike ({{ count($post->postLikes) }}) </span>
                                                                    </a>

                                                                @elseif(empty($post->postLikes()->where('user_id', Auth::user()->id)->first()))
                                                                    <a href="#" wire:click="addLike({{ $post->id }})"> <i class="icofont icofont-like text-success" ></i>
                                                                        <span class="b-r-muted">Like ({{ count($post->postLikes) }}) </span>
                                                                    </a>
                                                                @endif
                                                                <a href="#"> <i class="icofont icofont-comment text-muted"></i> <span class="b-r-muted">Comments ({{ count($post->postComments) }})</span></a>
                                                                <a href="#"> <i class="ti-eye text-muted"></i> <span>View (10)</span></a>
                                                            </div>
                                                            <div class="card-block user-box">
                                                                <div class="p-b-30"> <span class="f-14"><a href="#">Comments ({{ count($post->postComments) }})</a></span>

                                                                </div>

                                                                @foreach($post->postComments as $comment)
                                                                    <div class="media m-b-20">
                                                                        <a class="media-left" href="{{ route('view-profile', $comment->user->url) }}">
                                                                            <img class="media-object img-radius m-r-20" src="{{ $comment->user->avatar ?? '/assets/images/avatar-1.jpg' }}" alt="{{ $comment->user->first_name }} {{ $comment->user->surname ?? '' }}">
                                                                        </a>
                                                                        <div class="media-body b-b-muted social-client-description">
                                                                            <div class="chat-header"> <a href="{{ route('view-profile', $comment->user->url) }}"> {{ $comment->user->first_name }} {{ $comment->user->surname ?? '' }} </a> <span class="text-muted">{{date('d M, Y', strtotime($comment->created_at)) }} <small>({{ $comment->created_at->diffForHumans() }})</small></span></div>
                                                                            <p class="text-muted"> {!! $comment->comment !!} </p>
                                                                        </div>
                                                                    </div>
                                                                @endforeach

                                                                <div class="media">
                                                                    <a class="media-left" href="{{ route('view-profile', Auth::user()->url) }}">
                                                                        <img class="media-object img-radius m-r-20" src="{{ Auth::user()->avatar ?? '/assets/images/user.png' }}" alt="Generic placeholder image">
                                                                    </a>
                                                                    <div class="media-body">

                                                                        <div class="">
                                                                            <textarea wire:model.debounce.50000ms="comment" rows="5" cols="5" class="form-control" placeholder="Leave comment"></textarea>

                                                                            <div class="text-right m-t-20">
                                                                                <button class="btn btn-out-dashed btn-primary btn-square btn-sm" type="button" wire:click="comment({{ $post->id }})">Comment</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @elseif($post->post_type == 'project')
                                    <div class="social-timelines p-relative">
                                        <div class="row timeline-right p-t-35">
                                            <div class="col-2 col-sm-2 col-xl-1">
                                                <div class="social-timelines-left">
                                                    <img class="img-radius timeline-icon" src="{{ $post->user->avatar ?? '/assets/images/avatar-2.jpg' }}" alt="">
                                                </div>
                                            </div>
                                            <div class="col-10 col-sm-10 col-xl-11 p-l-5 p-b-35">
                                                <div class="card">

                                                    <div class="card-block post-timelines">
                                                        <span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>
                                                        <div class="dropdown-menu dropdown-menu-right b-none services-list">
                                                            <a class="dropdown-item" href="#">Remove tag</a>
                                                            <a class="dropdown-item" href="#">Report Photo</a>
                                                            <a class="dropdown-item" href="#">Hide From Timeline</a>
                                                            <a class="dropdown-item" href="#">Blog User</a>
                                                        </div>
                                                        <div class="chat-header f-w-600">{{$post->user->first_name ?? ''}} {{$post->user->surname ?? ''}} {<i class="ti-briefcase text-inverse mr-1 ml-1"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Project"></i>} |

                                                            {{$post->post_title ?? ''}}

                                                        </div>
                                                        <div class="social-time text-muted">{{$post->created_at->diffForHumans()}}</div>
                                                    </div>
                                                    <div class="card-block">

                                                        <div class="timeline-details">
                                                            <p class="text-muted">{!! $post->post_content ?? '' !!}</p>
                                                        </div>
                                                    </div>
                                                    <div class="card-block b-b-theme b-t-theme social-msg">
                                                        @if(!empty($post->postLikes()->where('user_id', Auth::user()->id)->first()))
                                                            <a href="#" wire:click="unLike({{ $post->id }})"> <i class="icofont icofont-thumbs-down text-danger" ></i>
                                                                <span class="b-r-muted">Unlike ({{ count($post->postLikes) }}) </span>
                                                            </a>

                                                        @elseif(empty($post->postLikes()->where('user_id', Auth::user()->id)->first()))
                                                            <a href="#" wire:click="addLike({{ $post->id }})"> <i class="icofont icofont-like text-success" ></i>
                                                                <span class="b-r-muted">Like ({{ count($post->postLikes) }}) </span>
                                                            </a>
                                                        @endif

                                                        <a href="#"> <i class="icofont icofont-comment text-muted"></i> <span class="b-r-muted">Comments ({{ count($post->postComments) }})</span></a>
                                                        <a href="#"> <i class="ti-eye text-muted"></i> <span>View (1110)</span></a>
                                                    </div>
                                                    <div class="card-block user-box">
                                                        <div class="p-b-30"> <span class="f-14"><a href="#">Comments ({{ count($post->postComments) }})</a></span>
                                                        </div>

                                                        @foreach($post->postComments as $comment)
                                                            <div class="media m-b-20">
                                                                <a class="media-left" href="{{ route('view-profile', $comment->user->url) }}">
                                                                    <img class="media-object img-radius m-r-20" src="{{ $comment->user->avatar ?? '/assets/images/avatar-1.jpg' }}" alt="{{ $comment->user->first_name }} {{ $comment->user->surname ?? '' }}">
                                                                </a>
                                                                <div class="media-body b-b-muted social-client-description">
                                                                    <div class="chat-header"> <a href="{{ route('view-profile', $comment->user->url) }}">  {{ $comment->user->first_name }} {{ $comment->user->surname ?? '' }} </a>  <span class="text-muted">{{date('d M, Y', strtotime($comment->created_at)) }} <small>({{ $comment->created_at->diffForHumans() }})</small></span></div>
                                                                    <p class="text-muted"> {!! $comment->comment !!} </p>
                                                                </div>
                                                            </div>
                                                        @endforeach

                                                        <div class="media">
                                                            <a class="media-left" href="{{ route('view-profile', Auth::user()->url) }}">
                                                                <img class="media-object img-radius m-r-20" src="{{ Auth::user()->avatar ?? '/assets/images/user.png' }}" alt="Generic placeholder image">
                                                            </a>
                                                            <div class="media-body">

                                                                    <div class="">
                                                                        <textarea wire:model.debounce.50000ms="comment" rows="5" cols="5" class="form-control" placeholder="Leave comment"></textarea>

                                                                        <div class="text-right m-t-20">
                                                                            <button class="btn btn-out-dashed btn-primary btn-square btn-sm" type="button" wire:click="comment({{ $post->id }})">Comment</button>
                                                                        </div>
                                                                    </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($post->post_type == 'expense-request')
                                    <div class="social-timelines p-relative">
                                        <div class="row timeline-right p-t-35">
                                            <div class="col-2 col-sm-2 col-xl-1">
                                                <div class="social-timelines-left">
                                                    <img class="img-radius timeline-icon" src="{{ $post->user->avatar ?? '/assets/images/avatar-2.jpg' }}" alt="">
                                                </div>
                                            </div>
                                            <div class="col-10 col-sm-10 col-xl-11 p-l-5 p-b-35">
                                                <div class="card">

                                                    <div class="card-block post-timelines">
                                                        <span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>
                                                        <div class="dropdown-menu dropdown-menu-right b-none services-list">
                                                            <a class="dropdown-item" href="#">Remove tag</a>
                                                            <a class="dropdown-item" href="#">Report Photo</a>
                                                            <a class="dropdown-item" href="#">Hide From Timeline</a>
                                                            <a class="dropdown-item" href="#">Blog User</a>
                                                        </div>
                                                        <div class="chat-header f-w-600">{{$post->user->first_name ?? ''}} {{$post->user->surname ?? ''}} {<i class="ti-wallet text-inverse mr-1 ml-1"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Expense Request"></i>} |

                                                            {{$post->post_title ?? ''}}

                                                        </div>
                                                        <div class="social-time text-muted">{{$post->created_at->diffForHumans()}}</div>
                                                    </div>
                                                    <div class="card-block">

                                                        <div class="timeline-details">
                                                            <strong>Expense Report</strong>
                                                            <div class="row">
                                                                <div class="card-block">
                                                                    <div class="team-box p-b-20">
                                                                        <div class="team-section d-inline-block">
                                                                                <i class="ti-timer mr-1 text-warning"></i>
                                                                            <a href="#! "><img src="\assets\images\avatar-2.jpg" style="border-radius: 50%; border:2px solid red; height:64px; width:64px;" data-toggle="tooltip" title="" alt=" " data-original-title="Josephin Doe"></a>
                                                                                <i class="zmdi zmdi-long-arrow-right"></i>
                                                                                <i class="ti-check-box mr-1 text-success"></i>
                                                                            <a href="#! "><img src="\assets\images\avatar-3.jpg" style="border-radius: 50%; border:2px solid red; height:64px; width:64px;" data-toggle="tooltip" title="" alt=" " class="m-l-5 " data-original-title="Lary Doe"></a>
                                                                                <i class="zmdi zmdi-long-arrow-right"></i>
                                                                                <i class="ti-na text-danger"></i>
                                                                            <a href="#! "><img src="\assets\images\avatar-4.jpg" style="border-radius: 50%; border:2px solid red; height:64px; width:64px;" data-toggle="tooltip" title="" alt=" " class="m-l-5 " data-original-title="Alia"></a>
                                                                                <i class="zmdi zmdi-long-arrow-right"></i>
                                                                                <i class="ti-na text-danger"></i>
                                                                            <a href="#! "><img src="\assets\images\avatar-2.jpg" style="border-radius: 50%; border:2px solid red; height:64px; width:64px;" data-toggle="tooltip" title="" alt=" " class="m-l-5 " data-original-title="Suzen"></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <p class="text-muted">{!! $post->post_content ?? '' !!}</p>
                                                                <div class="row">
                                                                    <div class="col-md-12 d-flex justify-content-center">
                                                                        <div class="btn-group">
                                                                            <button class="btn btn-out-dashed btn-danger btn-square btn-sm"><i class="ti-na mr-2"></i> DECLINE</button>
                                                                            <button class="btn btn-out-dashed btn-success btn-square btn-sm"><i class="ti-check-box mr-2"></i> APPROVE</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-block b-b-theme b-t-theme social-msg">
                                                        @if(!empty($post->postLikes()->where('user_id', Auth::user()->id)->first()))
                                                            <a href="#" wire:click="unLike({{ $post->id }})"> <i class="icofont icofont-thumbs-down text-danger" ></i>
                                                                <span class="b-r-muted">Unlike ({{ count($post->postLikes) }}) </span>
                                                            </a>

                                                        @elseif(empty($post->postLikes()->where('user_id', Auth::user()->id)->first()))
                                                            <a href="#" wire:click="addLike({{ $post->id }})"> <i class="icofont icofont-like text-success" ></i>
                                                                <span class="b-r-muted">Like ({{ count($post->postLikes) }}) </span>
                                                            </a>
                                                        @endif

                                                        <a href="#"> <i class="icofont icofont-comment text-muted"></i> <span class="b-r-muted">Comments ({{ count($post->postComments) }})</span></a>
                                                        <a href="#"> <i class="ti-eye text-muted"></i> <span>View (1110)</span></a>
                                                    </div>
                                                    <div class="card-block user-box">
                                                        <div class="p-b-30"> <span class="f-14"><a href="#">Comments ({{ count($post->postComments) }})</a></span>
                                                        </div>

                                                        @foreach($post->postComments as $comment)
                                                            <div class="media m-b-20">
                                                                <a class="media-left" href="{{ route('view-profile', $comment->user->url) }}">
                                                                    <img class="media-object img-radius m-r-20" src="{{ $comment->user->avatar ?? '/assets/images/avatar-1.jpg' }}" alt="{{ $comment->user->first_name }} {{ $comment->user->surname ?? '' }}">
                                                                </a>
                                                                <div class="media-body b-b-muted social-client-description">
                                                                    <div class="chat-header"> <a href="{{ route('view-profile', $comment->user->url) }}">  {{ $comment->user->first_name }} {{ $comment->user->surname ?? '' }} </a>  <span class="text-muted">{{date('d M, Y', strtotime($comment->created_at)) }} <small>({{ $comment->created_at->diffForHumans() }})</small></span></div>
                                                                    <p class="text-muted"> {!! $comment->comment !!} </p>
                                                                </div>
                                                            </div>
                                                        @endforeach

                                                        <div class="media">
                                                            <a class="media-left" href="{{ route('view-profile', Auth::user()->url) }}">
                                                                <img class="media-object img-radius m-r-20" src="{{ Auth::user()->avatar ?? '/assets/images/user.png' }}" alt="Generic placeholder image">
                                                            </a>
                                                            <div class="media-body">

                                                                    <div class="">
                                                                        <textarea wire:model.debounce.50000ms="comment" rows="5" cols="5" class="form-control" placeholder="Leave comment"></textarea>

                                                                        <div class="text-right m-t-20">
                                                                            <button class="btn btn-out-dashed btn-primary btn-square btn-sm" type="button" wire:click="comment({{ $post->id }})">Comment</button>
                                                                        </div>
                                                                    </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @elseif($post->post_type == 'purchase-request')
                                    <div class="social-timelines p-relative">
                                        <div class="row timeline-right p-t-35">
                                            <div class="col-2 col-sm-2 col-xl-1">
                                                <div class="social-timelines-left">
                                                    <img class="img-radius timeline-icon" src="{{ $post->user->avatar ?? '/assets/images/avatar-2.jpg' }}" alt="">
                                                </div>
                                            </div>
                                            <div class="col-10 col-sm-10 col-xl-11 p-l-5 p-b-35">
                                                <div class="card">

                                                    <div class="card-block post-timelines">
                                                        <span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>
                                                        <div class="dropdown-menu dropdown-menu-right b-none services-list">
                                                            <a class="dropdown-item" href="#">Remove tag</a>
                                                            <a class="dropdown-item" href="#">Report Photo</a>
                                                            <a class="dropdown-item" href="#">Hide From Timeline</a>
                                                            <a class="dropdown-item" href="#">Blog User</a>
                                                        </div>
                                                        <div class="chat-header f-w-600">
                                                            <a href="{{ route('view-profile', $post->user->url) }}">{{$post->user->first_name ?? ''}} {{$post->user->surname ?? ''}} </a> | {<i class="ti-tag text-inverse mr-1 ml-1"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Purchase Request"></i>} |

                                                        <a href="{{ route('view-workflow-task', $post->post_url) }}"> {{$post->post_title ?? ''}} </a>

                                                        </div>
                                                        <div class="social-time text-muted">{{ date('d F, Y | h:i a') }} <small>({{$post->created_at->diffForHumans()}})</small> </div>
                                                    </div>
                                                    <div class="card-block">

                                                        <div class="timeline-details">
                                                            <strong>Purchase Request</strong>
                                                            <div class="row">
                                                                <div class="col-md-12 d-flex justify-content-center">
                                                                    <div class="card-block">
                                                                        <div class="team-box p-b-20">
                                                                            <div class="team-section d-inline-block">
                                                                                <a href="#! "><img src="{{$post->user->avatar ?? '\assets\images\avatar-3.jpg'}}" style="border-radius: 50%; height:64px; width:64px;" data-toggle="tooltip" title="" alt=" " data-original-title="{{$post->user->first_name }} {{$post->user->surname ?? ''}} is the requester"></a>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                        @foreach ($post->responsiblePersons as $processor)
                                                                            <div class="card-block" style="padding:10px;">
                                                                                <div class="team-box p-b-10">
                                                                                    <div class="team-section d-inline-block">
                                                                                        @if($processor->status == 'in-progress')
                                                                                            <i class="ti-timer mr-1 text-warning"></i>
                                                                                        @elseif($processor->status == 'approve')
                                                                                            <i class="ti-check-box mr-1 text-success"></i>
                                                                                        @elseif($processor->status == 'decline')
                                                                                            <i class="ti-na text-danger"></i>
                                                                                        @endif
                                                                                        <a href="#! "><img src="{{$processor->user->avatar ?? '\assets\images\avatar-3.jpg'}}" style="border-radius: 50%; height:64px; width:64px;" data-toggle="tooltip" title="" alt=" " data-original-title="{{$processor->user->first_name }} {{$processor->user->surname ?? ''}} {{$processor->status}} request"></a>
                                                                                        @if (end($processor))
                                                                                            <i class="zmdi zmdi-long-arrow-right"></i>

                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach

                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12 d-flex justify-content-center">
                                                                    <div class="btn-group">
                                                                        @if($post->post_status == 'in-progress')
                                                                            @foreach($post->responsiblePersons as $app)

                                                                            @if($app->user_id == Auth::user()->id && $app->status == 'in-progress')
                                                                                    <button class="btn btn-out-dashed btn-danger btn-square btn-sm" wire:click="declineRequest({{ $post->id }})"><i class="ti-na mr-2"></i> DECLINE</button>

                                                                                    <button type="button" class="btn btn-success btn-out-dashed btn-square btn-sm approveBtn" wire:click="approveRequest({{ $post->id }})"> <i class="ti-check-box mr-2"></i>
                                                                                        APPROVE
                                                                                    </button>
                                                                                @elseif($app->user_id == Auth::user()->id && $app->status == 'decline')
                                                                                    {{-- <button class="btn btn-out-dashed btn-danger btn-square btn-sm" disabled><i class="ti-na mr-2"></i> DECLINE</button> --}}
                                                                                    <i>You previously declined this request</i>
                                                                                @elseif($app->user_id == Auth::user()->id && $app->status == 'approve')
                                                                                    <i>You previously approved this request</i>
                                                                                        {{-- <button class="btn btn-out-dashed btn-success btn-square btn-sm" disabled><i class="ti-check-box mr-2"></i> APPROVE</button> --}}
                                                                                @endif
                                                                            @endforeach
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <p class="text-muted">{!! $post->post_content ?? '' !!}</p>
                                                        </div>
                                                    </div>
                                                    <div class="card-block b-b-theme b-t-theme social-msg">
                                                        @if(!empty($post->postLikes()->where('user_id', Auth::user()->id)->first()))
                                                            <a href="#" wire:click="unLike({{ $post->id }})"> <i class="icofont icofont-thumbs-down text-danger" ></i>
                                                                <span class="b-r-muted">Unlike ({{ count($post->postLikes) }}) </span>
                                                            </a>

                                                        @elseif(empty($post->postLikes()->where('user_id', Auth::user()->id)->first()))
                                                            <a href="#" wire:click="addLike({{ $post->id }})"> <i class="icofont icofont-like text-success" ></i>
                                                                <span class="b-r-muted">Like ({{ count($post->postLikes) }}) </span>
                                                            </a>
                                                        @endif

                                                        <a href="#"> <i class="icofont icofont-comment text-muted"></i> <span class="b-r-muted">Comments ({{ count($post->postComments) }})</span></a>
                                                        <a href="#"> <i class="ti-eye text-muted"></i> <span>View (1110)</span></a>
                                                    </div>
                                                    <div class="card-block user-box">
                                                        <div class="p-b-30"> <span class="f-14"><a href="#">Comments ({{ count($post->postComments) }})</a></span>
                                                            </div>

                                                        @foreach($post->postComments as $comment)
                                                            <div class="media m-b-20">
                                                                <a class="media-left" href="{{ route('view-profile', $comment->user->url) }}">
                                                                    <img class="media-object img-radius m-r-20" src="{{ $comment->user->avatar ?? '/assets/images/avatar-1.jpg' }}" alt="{{ $comment->user->first_name }} {{ $comment->user->surname ?? '' }}">
                                                                </a>
                                                                <div class="media-body b-b-muted social-client-description">
                                                                    <div class="chat-header"> <a href="{{ route('view-profile', $comment->user->url) }}">  {{ $comment->user->first_name }} {{ $comment->user->surname ?? '' }} </a>  <span class="text-muted">{{date('d M, Y', strtotime($comment->created_at)) }} <small>({{ $comment->created_at->diffForHumans() }})</small></span></div>
                                                                    <p class="text-muted"> {!! $comment->comment !!} </p>
                                                                </div>
                                                            </div>
                                                        @endforeach

                                                        <div class="media">
                                                            <a class="media-left" href="{{ route('view-profile', Auth::user()->url) }}">
                                                                <img class="media-object img-radius m-r-20" src="{{ Auth::user()->avatar ?? '/assets/images/user.png' }}" alt="Generic placeholder image">
                                                            </a>
                                                            <div class="media-body">

                                                                    <div class="">
                                                                        <textarea wire:model.debounce.50000ms="comment" rows="5" cols="5" class="form-control" placeholder="Leave comment"></textarea>

                                                                        <div class="text-right m-t-20">
                                                                            <button class="btn btn-out-dashed btn-primary btn-square btn-sm" type="button" wire:click="comment({{ $post->id }})">Comment</button>
                                                                        </div>
                                                                    </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @elseif($post->post_type == 'general-request')
                                    <div class="social-timelines p-relative">
                                        <div class="row timeline-right p-t-35">
                                            <div class="col-2 col-sm-2 col-xl-1">
                                                <div class="social-timelines-left">
                                                    <img class="img-radius timeline-icon" src="{{ $post->user->avatar ?? '/assets/images/avatar-2.jpg' }}" alt="">
                                                </div>
                                            </div>
                                            <div class="col-10 col-sm-10 col-xl-11 p-l-5 p-b-35">
                                                <div class="card">

                                                    <div class="card-block post-timelines">
                                                        <span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>
                                                        <div class="dropdown-menu dropdown-menu-right b-none services-list">
                                                            <a class="dropdown-item" href="#">Remove tag</a>
                                                            <a class="dropdown-item" href="#">Report Photo</a>
                                                            <a class="dropdown-item" href="#">Hide From Timeline</a>
                                                            <a class="dropdown-item" href="#">Blog User</a>
                                                        </div>
                                                        <div class="chat-header f-w-600">{{$post->user->first_name ?? ''}} {{$post->user->surname ?? ''}} {<i class="ti-signal text-inverse mr-1 ml-1"  data-toggle="tooltip" data-placement="top" title="" data-original-title="General Request"></i>} |

                                                            {{$post->post_title ?? ''}}

                                                        </div>
                                                        <div class="social-time text-muted">{{$post->created_at->diffForHumans()}}</div>
                                                    </div>
                                                    <div class="card-block">

                                                        <div class="timeline-details">
                                                            <strong>General Request</strong>
                                                            <div class="row">
                                                                <div class="card-block">
                                                                    <div class="team-box p-b-20">
                                                                        <div class="team-section d-inline-block">
                                                                                <i class="ti-timer mr-1 text-warning"></i>
                                                                            <a href="#! "><img src="\assets\images\avatar-2.jpg" style="border-radius: 50%; border:2px solid red; height:64px; width:64px;" data-toggle="tooltip" title="" alt=" " data-original-title="Josephin Doe"></a>
                                                                                <i class="zmdi zmdi-long-arrow-right"></i>
                                                                                <i class="ti-check-box mr-1 text-success"></i>
                                                                            <a href="#! "><img src="\assets\images\avatar-3.jpg" style="border-radius: 50%; border:2px solid red; height:64px; width:64px;" data-toggle="tooltip" title="" alt=" " class="m-l-5 " data-original-title="Lary Doe"></a>
                                                                                <i class="zmdi zmdi-long-arrow-right"></i>
                                                                                <i class="ti-na text-danger"></i>
                                                                            <a href="#! "><img src="\assets\images\avatar-4.jpg" style="border-radius: 50%; border:2px solid red; height:64px; width:64px;" data-toggle="tooltip" title="" alt=" " class="m-l-5 " data-original-title="Alia"></a>
                                                                                <i class="zmdi zmdi-long-arrow-right"></i>
                                                                                <i class="ti-na text-danger"></i>
                                                                            <a href="#! "><img src="\assets\images\avatar-2.jpg" style="border-radius: 50%; border:2px solid red; height:64px; width:64px;" data-toggle="tooltip" title="" alt=" " class="m-l-5 " data-original-title="Suzen"></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <p class="text-muted">{!! $post->post_content ?? '' !!}</p>
                                                                <div class="row">
                                                                    <div class="col-md-12 d-flex justify-content-center">
                                                                        <div class="btn-group">
                                                                            <button class="btn btn-out-dashed btn-danger btn-square btn-sm"><i class="ti-na mr-2"></i> DECLINE</button>
                                                                            <button class="btn btn-out-dashed btn-success btn-square btn-sm"><i class="ti-check-box mr-2"></i> APPROVE</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-block b-b-theme b-t-theme social-msg">
                                                        @if(!empty($post->postLikes()->where('user_id', Auth::user()->id)->first()))
                                                            <a href="#" wire:click="unLike({{ $post->id }})"> <i class="icofont icofont-thumbs-down text-danger" ></i>
                                                                <span class="b-r-muted">Unlike ({{ count($post->postLikes) }}) </span>
                                                            </a>

                                                        @elseif(empty($post->postLikes()->where('user_id', Auth::user()->id)->first()))
                                                            <a href="#" wire:click="addLike({{ $post->id }})"> <i class="icofont icofont-like text-success" ></i>
                                                                <span class="b-r-muted">Like ({{ count($post->postLikes) }}) </span>
                                                            </a>
                                                        @endif

                                                        <a href="#"> <i class="icofont icofont-comment text-muted"></i> <span class="b-r-muted">Comments ({{ count($post->postComments) }})</span></a>
                                                        <a href="#"> <i class="ti-eye text-muted"></i> <span>View (1110)</span></a>
                                                    </div>
                                                    <div class="card-block user-box">
                                                        <div class="p-b-30"> <span class="f-14"><a href="#">Comments ({{ count($post->postComments) }})</a></span>
                                                        </div>

                                                        @foreach($post->postComments as $comment)
                                                            <div class="media m-b-20">
                                                                <a class="media-left" href="{{ route('view-profile', $comment->user->url) }}">
                                                                    <img class="media-object img-radius m-r-20" src="{{ $comment->user->avatar ?? '/assets/images/avatar-1.jpg' }}" alt="{{ $comment->user->first_name }} {{ $comment->user->surname ?? '' }}">
                                                                </a>
                                                                <div class="media-body b-b-muted social-client-description">
                                                                    <div class="chat-header"> <a href="{{ route('view-profile', $comment->user->url) }}">  {{ $comment->user->first_name }} {{ $comment->user->surname ?? '' }} </a>  <span class="text-muted">{{date('d M, Y', strtotime($comment->created_at)) }} <small>({{ $comment->created_at->diffForHumans() }})</small></span></div>
                                                                    <p class="text-muted"> {!! $comment->comment !!} </p>
                                                                </div>
                                                            </div>
                                                        @endforeach

                                                        <div class="media">
                                                            <a class="media-left" href="{{ route('view-profile', Auth::user()->url) }}">
                                                                <img class="media-object img-radius m-r-20" src="{{ Auth::user()->avatar ?? '/assets/images/user.png' }}" alt="Generic placeholder image">
                                                            </a>
                                                            <div class="media-body">

                                                                    <div class="">
                                                                        <textarea wire:model.debounce.50000ms="comment" rows="5" cols="5" class="form-control" placeholder="Leave comment"></textarea>

                                                                        <div class="text-right m-t-20">
                                                                            <button class="btn btn-out-dashed btn-primary btn-square btn-sm" type="button" wire:click="comment({{ $post->id }})">Comment</button>
                                                                        </div>
                                                                    </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @elseif($post->post_type == 'business-trip')
                                    <div class="social-timelines p-relative">
                                        <div class="row timeline-right p-t-35">
                                            <div class="col-2 col-sm-2 col-xl-1">
                                                <div class="social-timelines-left">
                                                    <img class="img-radius timeline-icon" src="{{ $post->user->avatar ?? '/assets/images/avatar-2.jpg' }}" alt="">
                                                </div>
                                            </div>
                                            <div class="col-10 col-sm-10 col-xl-11 p-l-5 p-b-35">
                                                <div class="card">

                                                    <div class="card-block post-timelines">
                                                        <span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>
                                                        <div class="dropdown-menu dropdown-menu-right b-none services-list">
                                                            <a class="dropdown-item" href="#">Remove tag</a>
                                                            <a class="dropdown-item" href="#">Report Photo</a>
                                                            <a class="dropdown-item" href="#">Hide From Timeline</a>
                                                            <a class="dropdown-item" href="#">Blog User</a>
                                                        </div>
                                                        <div class="chat-header f-w-600">{{$post->user->first_name ?? ''}} {{$post->user->surname ?? ''}} {<i class="ti-car text-inverse mr-1 ml-1"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Business Trip"></i>} |

                                                            {{$post->post_title ?? ''}}

                                                        </div>
                                                        <div class="social-time text-muted">{{$post->created_at->diffForHumans()}}</div>
                                                    </div>
                                                    <div class="card-block">

                                                        <div class="timeline-details">
                                                            <strong>Business Trip</strong>
                                                            <div class="row">
                                                                <div class="card-block">
                                                                    <div class="team-box p-b-20">
                                                                        <div class="team-section d-inline-block">
                                                                                <i class="ti-timer mr-1 text-warning"></i>
                                                                            <a href="#! "><img src="\assets\images\avatar-2.jpg" style="border-radius: 50%; border:2px solid red; height:64px; width:64px;" data-toggle="tooltip" title="" alt=" " data-original-title="Josephin Doe"></a>
                                                                                <i class="zmdi zmdi-long-arrow-right"></i>
                                                                                <i class="ti-check-box mr-1 text-success"></i>
                                                                            <a href="#! "><img src="\assets\images\avatar-3.jpg" style="border-radius: 50%; border:2px solid red; height:64px; width:64px;" data-toggle="tooltip" title="" alt=" " class="m-l-5 " data-original-title="Lary Doe"></a>
                                                                                <i class="zmdi zmdi-long-arrow-right"></i>
                                                                                <i class="ti-na text-danger"></i>
                                                                            <a href="#! "><img src="\assets\images\avatar-4.jpg" style="border-radius: 50%; border:2px solid red; height:64px; width:64px;" data-toggle="tooltip" title="" alt=" " class="m-l-5 " data-original-title="Alia"></a>
                                                                                <i class="zmdi zmdi-long-arrow-right"></i>
                                                                                <i class="ti-na text-danger"></i>
                                                                            <a href="#! "><img src="\assets\images\avatar-2.jpg" style="border-radius: 50%; border:2px solid red; height:64px; width:64px;" data-toggle="tooltip" title="" alt=" " class="m-l-5 " data-original-title="Suzen"></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <p class="text-muted">{!! $post->post_content ?? '' !!}</p>
                                                                <div class="row">
                                                                    <div class="col-md-12 d-flex justify-content-center">
                                                                        <div class="btn-group">
                                                                            <button class="btn btn-out-dashed btn-danger btn-square btn-sm"><i class="ti-na mr-2"></i> DECLINE</button>
                                                                            <button class="btn btn-out-dashed btn-success btn-square btn-sm"><i class="ti-check-box mr-2"></i> APPROVE</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-block b-b-theme b-t-theme social-msg">
                                                        @if(!empty($post->postLikes()->where('user_id', Auth::user()->id)->first()))
                                                            <a href="#" wire:click="unLike({{ $post->id }})"> <i class="icofont icofont-thumbs-down text-danger" ></i>
                                                                <span class="b-r-muted">Unlike ({{ count($post->postLikes) }}) </span>
                                                            </a>

                                                        @elseif(empty($post->postLikes()->where('user_id', Auth::user()->id)->first()))
                                                            <a href="#" wire:click="addLike({{ $post->id }})"> <i class="icofont icofont-like text-success" ></i>
                                                                <span class="b-r-muted">Like ({{ count($post->postLikes) }}) </span>
                                                            </a>
                                                        @endif

                                                        <a href="#"> <i class="icofont icofont-comment text-muted"></i> <span class="b-r-muted">Comments ({{ count($post->postComments) }})</span></a>
                                                        <a href="#"> <i class="ti-eye text-muted"></i> <span>View (1110)</span></a>
                                                    </div>
                                                    <div class="card-block user-box">
                                                        <div class="p-b-30"> <span class="f-14"><a href="#">Comments ({{ count($post->postComments) }})</a></span>
                                                        </div>

                                                        @foreach($post->postComments as $comment)
                                                            <div class="media m-b-20">
                                                                <a class="media-left" href="{{ route('view-profile', $comment->user->url) }}">
                                                                    <img class="media-object img-radius m-r-20" src="{{ $comment->user->avatar ?? '/assets/images/avatar-1.jpg' }}" alt="{{ $comment->user->first_name }} {{ $comment->user->surname ?? '' }}">
                                                                </a>
                                                                <div class="media-body b-b-muted social-client-description">
                                                                    <div class="chat-header"> <a href="{{ route('view-profile', $comment->user->url) }}">  {{ $comment->user->first_name }} {{ $comment->user->surname ?? '' }} </a>  <span class="text-muted">{{date('d M, Y', strtotime($comment->created_at)) }} <small>({{ $comment->created_at->diffForHumans() }})</small></span></div>
                                                                    <p class="text-muted"> {!! $comment->comment !!} </p>
                                                                </div>
                                                            </div>
                                                        @endforeach

                                                        <div class="media">
                                                            <a class="media-left" href="{{ route('view-profile', Auth::user()->url) }}">
                                                                <img class="media-object img-radius m-r-20" src="{{ Auth::user()->avatar ?? '/assets/images/user.png' }}" alt="Generic placeholder image">
                                                            </a>
                                                            <div class="media-body">

                                                                    <div class="">
                                                                        <textarea wire:model.debounce.50000ms="comment" rows="5" cols="5" class="form-control" placeholder="Leave comment"></textarea>

                                                                        <div class="text-right m-t-20">
                                                                            <button class="btn btn-out-dashed btn-primary btn-square btn-sm" type="button" wire:click="comment({{ $post->id }})">Comment</button>
                                                                        </div>
                                                                    </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($post->post_type == 'leave-request')
                                    <div class="social-timelines p-relative">
                                        <div class="row timeline-right p-t-35">
                                            <div class="col-2 col-sm-2 col-xl-1">
                                                <div class="social-timelines-left">
                                                    <img class="img-radius timeline-icon" src="{{ $post->user->avatar ?? '/assets/images/avatar-2.jpg' }}" alt="">
                                                </div>
                                            </div>
                                            <div class="col-10 col-sm-10 col-xl-11 p-l-5 p-b-35">
                                                <div class="card">

                                                    <div class="card-block post-timelines">
                                                        <span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>
                                                        <div class="dropdown-menu dropdown-menu-right b-none services-list">
                                                            <a class="dropdown-item" href="#">Remove tag</a>
                                                            <a class="dropdown-item" href="#">Report Photo</a>
                                                            <a class="dropdown-item" href="#">Hide From Timeline</a>
                                                            <a class="dropdown-item" href="#">Blog User</a>
                                                        </div>
                                                        <div class="chat-header f-w-600">{{$post->user->first_name ?? ''}} {{$post->user->surname ?? ''}} {<i class="ti-id-badge text-inverse mr-1 ml-1"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Leave Request"></i>} |

                                                            {{$post->post_title ?? 'Leave Request'}}

                                                        </div>
                                                        <div class="social-time text-muted">{{$post->created_at->diffForHumans()}}</div>
                                                    </div>
                                                    <div class="card-block">

                                                        <div class="timeline-details">
                                                            <strong>Leave Request</strong>
                                                            <div class="row">
                                                                <div class="card-block">
                                                                    <div class="team-box p-b-20">
                                                                        <div class="team-section d-inline-block">
                                                                                <i class="ti-timer mr-1 text-warning"></i>
                                                                            <a href="#! "><img src="\assets\images\avatar-2.jpg" style="border-radius: 50%; border:2px solid red; height:64px; width:64px;" data-toggle="tooltip" title="" alt=" " data-original-title="Josephin Doe"></a>
                                                                                <i class="zmdi zmdi-long-arrow-right"></i>
                                                                                <i class="ti-check-box mr-1 text-success"></i>
                                                                            <a href="#! "><img src="\assets\images\avatar-3.jpg" style="border-radius: 50%; border:2px solid red; height:64px; width:64px;" data-toggle="tooltip" title="" alt=" " class="m-l-5 " data-original-title="Lary Doe"></a>
                                                                                <i class="zmdi zmdi-long-arrow-right"></i>
                                                                                <i class="ti-na text-danger"></i>
                                                                            <a href="#! "><img src="\assets\images\avatar-4.jpg" style="border-radius: 50%; border:2px solid red; height:64px; width:64px;" data-toggle="tooltip" title="" alt=" " class="m-l-5 " data-original-title="Alia"></a>
                                                                                <i class="zmdi zmdi-long-arrow-right"></i>
                                                                                <i class="ti-na text-danger"></i>
                                                                            <a href="#! "><img src="\assets\images\avatar-2.jpg" style="border-radius: 50%; border:2px solid red; height:64px; width:64px;" data-toggle="tooltip" title="" alt=" " class="m-l-5 " data-original-title="Suzen"></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <p class="text-muted">{!! $post->post_content ?? '' !!}</p>
                                                                <div class="row">
                                                                    <div class="col-md-12 d-flex justify-content-center">
                                                                        <div class="btn-group">
                                                                            <button class="btn btn-out-dashed btn-danger btn-square btn-sm"><i class="ti-na mr-2"></i> DECLINE</button>
                                                                            <button class="btn btn-out-dashed btn-success btn-square btn-sm"><i class="ti-check-box mr-2"></i> APPROVE</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-block b-b-theme b-t-theme social-msg">
                                                        @if(!empty($post->postLikes()->where('user_id', Auth::user()->id)->first()))
                                                            <a href="#" wire:click="unLike({{ $post->id }})"> <i class="icofont icofont-thumbs-down text-danger" ></i>
                                                                <span class="b-r-muted">Unlike ({{ count($post->postLikes) }}) </span>
                                                            </a>

                                                        @elseif(empty($post->postLikes()->where('user_id', Auth::user()->id)->first()))
                                                            <a href="#" wire:click="addLike({{ $post->id }})"> <i class="icofont icofont-like text-success" ></i>
                                                                <span class="b-r-muted">Like ({{ count($post->postLikes) }}) </span>
                                                            </a>
                                                        @endif

                                                        <a href="#"> <i class="icofont icofont-comment text-muted"></i> <span class="b-r-muted">Comments ({{ count($post->postComments) }})</span></a>
                                                        <a href="#"> <i class="ti-eye text-muted"></i> <span>View (1110)</span></a>
                                                    </div>
                                                    <div class="card-block user-box">
                                                        <div class="p-b-30"> <span class="f-14"><a href="#">Comments ({{ count($post->postComments) }})</a></span>
                                                        </div>

                                                        @foreach($post->postComments as $comment)
                                                            <div class="media m-b-20">
                                                                <a class="media-left" href="{{ route('view-profile', $comment->user->url) }}">
                                                                    <img class="media-object img-radius m-r-20" src="{{ $comment->user->avatar ?? '/assets/images/avatar-1.jpg' }}" alt="{{ $comment->user->first_name }} {{ $comment->user->surname ?? '' }}">
                                                                </a>
                                                                <div class="media-body b-b-muted social-client-description">
                                                                    <div class="chat-header"> <a href="{{ route('view-profile', $comment->user->url) }}">  {{ $comment->user->first_name }} {{ $comment->user->surname ?? '' }} </a>  <span class="text-muted">{{date('d M, Y', strtotime($comment->created_at)) }} <small>({{ $comment->created_at->diffForHumans() }})</small></span></div>
                                                                    <p class="text-muted"> {!! $comment->comment !!} </p>
                                                                </div>
                                                            </div>
                                                        @endforeach

                                                        <div class="media">
                                                            <a class="media-left" href="{{ route('view-profile', Auth::user()->url) }}">
                                                                <img class="media-object img-radius m-r-20" src="{{ Auth::user()->avatar ?? '/assets/images/user.png' }}" alt="Generic placeholder image">
                                                            </a>
                                                            <div class="media-body">

                                                                    <div class="">
                                                                        <textarea wire:model.debounce.50000ms="comment" rows="5" cols="5" class="form-control" placeholder="Leave comment"></textarea>

                                                                        <div class="text-right m-t-20">
                                                                            <button class="btn btn-out-dashed btn-primary btn-square btn-sm" type="button" wire:click="comment({{ $post->id }})">Comment</button>
                                                                        </div>
                                                                    </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($post->post_type == 'memo')
                                    @foreach ($post->responsiblePersons as $person)
                                        @if($person->user_id == Auth::user()->id)

                                            <div class="social-timelines p-relative">
                                                <div class="row timeline-right p-t-35">
                                                    <div class="col-2 col-sm-2 col-xl-1">
                                                        <div class="social-timelines-left">
                                                            <img class="img-radius timeline-icon" src="{{ $post->user->avatar ?? '/assets/images/avatar-2.jpg' }}" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="col-10 col-sm-10 col-xl-11 p-l-5 p-b-35">
                                                        <div class="card">

                                                            <div class="card-block post-timelines">
                                                                <span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>
                                                                <div class="dropdown-menu dropdown-menu-right b-none services-list">
                                                                    <a class="dropdown-item" href="#">Remove tag</a>
                                                                    <a class="dropdown-item" href="#">Report Photo</a>
                                                                    <a class="dropdown-item" href="#">Hide From Timeline</a>
                                                                    <a class="dropdown-item" href="#">Blog User</a>
                                                                </div>
                                                                <div class="chat-header f-w-600">{{$post->user->first_name ?? ''}} {{$post->user->surname ?? ''}} {<i class="ti-clipboard text-inverse mr-1 ml-1"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Internal memo"></i>} <i class="zmdi zmdi-long-arrow-right text-primary"></i>
                                                                    @foreach($post->responsiblePersons as $res)
                                                                        @if ($res->user->user_id == 32)
                                                                            <small>All employees</small>
                                                                        @else
                                                                            <small>{{ $res->user->first_name ?? ''}} {{ $res->user->surname ?? ''}}</small>,

                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                                <div class="social-time text-muted">{{$post->created_at->diffForHumans()}}</div>
                                                            </div>
                                                            <div class="card-block">

                                                                <div class="timeline-details">
                                                                    <p class="text-muted">{!! $post->post_content ?? '' !!}</p>
                                                                </div>
                                                            </div>
                                                            <div class="card-block b-b-theme b-t-theme social-msg">
                                                                @if(!empty($post->postLikes()->where('user_id', Auth::user()->id)->first()))
                                                                    <a href="#" wire:click="unLike({{ $post->id }})"> <i class="icofont icofont-thumbs-down text-danger" ></i>
                                                                        <span class="b-r-muted">Unlike ({{ count($post->postLikes) }}) </span>
                                                                    </a>

                                                                @elseif(empty($post->postLikes()->where('user_id', Auth::user()->id)->first()))
                                                                    <a href="#" wire:click="addLike({{ $post->id }})"> <i class="icofont icofont-like text-success" ></i>
                                                                        <span class="b-r-muted">Like ({{ count($post->postLikes) }}) </span>
                                                                    </a>
                                                                @endif
                                                                <a href="#"> <i class="icofont icofont-comment text-muted"></i> <span class="b-r-muted">Comments ({{ count($post->postComments) }})</span></a>
                                                                <a href="#"> <i class="ti-eye text-muted"></i> <span>View (10)</span></a>
                                                            </div>
                                                            <div class="card-block user-box">
                                                                <div class="p-b-30"> <span class="f-14"><a href="#">Comments ({{ count($post->postComments) }})</a></span>
                                                                </div>

                                                                @foreach($post->postComments as $comment)
                                                                    <div class="media m-b-20">
                                                                        <a class="media-left" href="{{ route('view-profile', $comment->user->url) }}">
                                                                            <img class="media-object img-radius m-r-20" src="{{ $comment->user->avatar ?? '/assets/images/avatar-1.jpg' }}" alt="{{ $comment->user->first_name }} {{ $comment->user->surname ?? '' }}">
                                                                        </a>
                                                                        <div class="media-body b-b-muted social-client-description">
                                                                            <div class="chat-header"> <a href="{{ route('view-profile', $comment->user->url) }}"> {{ $comment->user->first_name }} {{ $comment->user->surname ?? '' }} </a> <span class="text-muted">{{date('d M, Y', strtotime($comment->created_at)) }} <small>({{ $comment->created_at->diffForHumans() }})</small></span></div>
                                                                            <p class="text-muted"> {!! $comment->comment !!} </p>
                                                                        </div>
                                                                    </div>
                                                                @endforeach

                                                                <div class="media">
                                                                    <a class="media-left" href="{{ route('view-profile', Auth::user()->url) }}">
                                                                        <img class="media-object img-radius m-r-20" src="{{ Auth::user()->avatar ?? '/assets/images/user.png' }}" alt="Generic placeholder image">
                                                                    </a>
                                                                    <div class="media-body">

                                                                        <div class="">
                                                                            <textarea wire:model.debounce.50000ms="comment" rows="5" cols="5" class="form-control" placeholder="Leave comment"></textarea>

                                                                            <div class="text-right m-t-20">
                                                                                <button class="btn btn-out-dashed btn-primary btn-square btn-sm" type="button" wire:click="comment({{ $post->id }})">Comment</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                    @endforeach
                                @endif
                            @endforeach



                        </div>
                    </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12 d-flex justify-content-center" style="cursor: pointer;">
                    {{-- {{ $posts->links() }} --}}
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="fb-timeliner">
                        <h2 class="recent-highlight bg-warning">Invite Users
                            <button class="btn btn-mini btn-default float-right" data-toggle="modal" data-target="#inviteUserModal" style="margin-top:-5px;"> <i class="ti-plus"></i> New</button>
                        </h2>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="fb-timeliner">
                        <h2 class="recent-highlight bg-secondary">Company Pulse
                            <label class="label label-success float-right">
                                35% <i class="m-l-10 feather icon-arrow-up"></i>
                            </label>
                        </h2>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="fb-timeliner">
                        <h2 class="recent-highlight bg-danger">My Tasks</h2>
                        <div class="card">
                            <div class="card-block">
                                <ul>
                                    <li class="active"><a href="#">On-going <label for="" class="badge badge-warning text-white float-right">{{$ongoing}}</label></a></li>
                                    <li><a href="#">Assisting <label for="" class="badge badge-secondary float-right">3</label></a></li>
                                    <li><a href="#">Set by me <label for="" class="badge badge-primary float-right">5</label></a></li>
                                    <li><a href="#">Following <label for="" class="badge badge-info float-right">3</label></a>  </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="fb-timeliner">
                        <h2 class="recent-highlight bg-info">Announcements</h2>
                        <div class="card">
                            <div class="card-block p-t-10">
                                <div class="task-right">
                                    <div class="task-right-header-status">
                                        <span data-toggle="collapse">Top Issuers</span>
                                    </div>
                                    @foreach ($announcements as $announce)
                                        <div class="user-box assign-user taskboard-right-users">
                                            <div class="media">
                                                <div class="media-left media-middle photo-table">
                                                    <a href="#">
                                                        <img class="media-object img-radius" src="\assets\images\avatar-1.jpg" alt="Generic placeholder image">
                                                        <div class="live-status bg-danger"></div>
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <a href="">{{ strlen($announce->post_title) > 35 ? substr($announce->post_title, 0, 35).'...' : $announce->post_title }}</a>
                                                    - {{date('d F, Y', strtotime($announce->created_at) )}} | <small>{{ $announce->created_at->diffForHumans() }}</small>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="fb-timeliner">
                        <h2 class="recent-highlight bg-info">Up-coming Events</h2>
                        <div class="card">
                            <div class="card-block">
                                <div class="user-box assign-user taskboard-right-users">
                                    <div class="media">
                                        <div class="media-left media-middle photo-table">
                                            <a href="#">
                                                <img class="media-object img-radius" src="\assets\images\avatar-1.jpg" alt="Generic placeholder image">
                                                <div class="live-status bg-danger"></div>
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <a href="">Event title</a>
                                            - Event date-time</small>
                                        </div>
                                    </div>
                                </div>
                                <hr>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="fb-timeliner">
                        <h2 class="recent-highlight bg-info">Up-coming Birthday(s)</h2>
                        <div class="card">
                            <div class="card-block">
                                <div class="user-box assign-user taskboard-right-users">
                                    <div class="media">
                                        <div class="media-left media-middle photo-table">
                                            <a href="#">
                                                <img class="media-object img-radius" src="\assets\images\avatar-1.jpg" alt="Generic placeholder image">
                                                <div class="live-status bg-danger"></div>
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <a href="">Celebrant name</a>
                                            - date month</small>
                                        </div>
                                    </div>
                                </div>
                                <hr>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="fb-timeliner">
                        <h2 class="recent-highlight bg-info">Weather Forecast</h2>
                        <div class="card">
                            <div class="card-block">
                                <div class="user-box assign-user taskboard-right-users">
                                    <div class="media">
                                        <div class="media-left media-middle photo-table">
                                            <a href="#">
                                                <img class="media-object img-radius" src="\assets\images\avatar-1.jpg" alt="Generic placeholder image">
                                                <div class="live-status bg-danger"></div>
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <a href="">Event title</a>
                                            - Event date-time</small>
                                        </div>
                                    </div>
                                </div>
                                <hr>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('activity-stream-exception')
    <script src="/assets/js/cus/activity-stream-short-cut.js"></script>
@endpush
