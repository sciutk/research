<ul class="simpleListings">
    @if ( count($journals) > 0  )


        @foreach($journals as $journal)
            <li>
                <a href="{{ route('journal.show',$journal->rj_id) }}">
                    <div class="title">{{ $journal->journal->rj_article_name }}
                        <span>{{ $journal->journal->rj_publish_date }}</span>
                    </div>
                </a>
                <div class="info">
                    {{ $journal->journal->rj_name }}
                    <a href="{{ $journal->journal->rj_source_url }}" title="#" target="_blank"
                       class="text-orange">{{ $journal->journal->rj_name }}</a>
                    @if($task == 'edit')
                        <div class="pull-right ">
                            <form id="rj_delete" action="{{ route('journal.destroy',$journal->journal->rj_id) }}"
                                  method="post">
                                <a href="{{ route('journal.edit',$journal->journal->rj_id) }}"
                                   class="btn btn-warning"><i class="fa fa-edit"></i> แก้ไข</a>

                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button class="btn btn-danger pull-right" style="margin-left: 5px" type="submit"><i
                                            class="fa fa-trash"></i> ลบ
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </li>
        @endforeach
    @else

        <div class="alert alert-info" role="alert">ไม่มีข้อมูลวารสารวิชาการ</div>

    @endif

</ul>