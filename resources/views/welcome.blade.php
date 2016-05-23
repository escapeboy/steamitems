<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="Page Description">
        <meta name="author" content="katsarov">
        <title>Page Title</title>

        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="container">
            <div class="dropdown">
              <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                Filter by type
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                  <li role="presentation" class="dropdown-header">
                      <a href="{{route('/')}}">All</a>
                  </li>
                  @foreach($types as $type)
                        <li role="presentation" class="dropdown-header">
                            <a href="{{route('/', ['type' => $type])}}">{{$type}}</a>
                        </li>
                  @endforeach
              </ul>
            </div>
            <div class="dropdown">
              <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                Per Page
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                  <li role="presentation" class="dropdown-header">
                      <a href="{{route('/', ['perPage' => 10, 'type' => request()->get('type')])}}">10</a>
                  </li>
                  <li role="presentation" class="dropdown-header">
                      <a href="{{route('/', ['perPage' => 20, 'type' => request()->get('type')])}}">20</a>
                  </li>
                  <li role="presentation" class="dropdown-header">
                      <a href="{{route('/', ['perPage' => 30, 'type' => request()->get('type')])}}">30</a>
                  </li>
                  <li role="presentation" class="dropdown-header">
                      <a href="{{route('/', ['perPage' => 40, 'type' => request()->get('type')])}}">40</a>
                  </li>
                  <li role="presentation" class="dropdown-header">
                      <a href="{{route('/', ['perPage' => 50, 'type' => request()->get('type')])}}">50</a>
                  </li>
              </ul>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php $i=1; ?>
                @foreach($items as $item)
                    @if($i%2==1) <tr> @endif
                        <td>
                            <div class="col-sm-3">
                                <img src="{{$item->image_url}}" class="img-responsive">
                            </div>
                            <div class="col-sm-9">
                                {{$item->item_name}}
                                <small class="help-block">{{$item->type}}</small>
                                <p>
                                    {{$item->item_description}}
                                </p>
                            </div>
                        </td>
                    @if($i%2==0) </tr> @endif
                    <?php $i++ ?>
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2">
                            @if($items)
                                @if ($items->lastPage() > 1)
                                    <ul class="pagination">
                                        <?php
                                        $start = $items->currentPage() - 5;
                                        $end = $items->currentPage() + 5;
                                        if($start < 1) $start = 1;
                                        if($end >= $items->lastPage() ) $end = $items->lastPage();
                                        ?>
                                            <li>
                                                <a href="{{ $items->url(1) }}" class="{{ ($items->currentPage() == 1) ? ' disabled' : '' }}"><</i></a>
                                            </li>
                                        @if($start>1)
                                            <li><a href="{{ $items->url(1) }}">{{1}}</a></li> <li><span>...</span></li>
                                        @endif
                                        @for ($i = $start; $i <= $end; $i++)
                                            <li class="{{ ($items->currentPage() == $i) ? ' active' : '' }}"><a href="{{ $items->url($i) }}">{{$i}}</a></li>
                                        @endfor
                                        @if($end<$items->lastPage())
                                            <li><span>...</span></li> <li><a href="{{ $items->url($items->lastPage()) }}">{{$items->lastPage()}}</a></li>
                                        @endif
                                            <li>
                                                <a href="{{ $items->url($items->currentPage()+1) }}" class="{{ ($items->currentPage() == $items->lastPage()) ? ' disabled' : '' }}">></a>
                                            </li>
                                    </ul>
                                @endif
                            @endif
                        </td>
                    </tr>
                    <tr>
                      <td colspan="2">
                        {{round($time, 3)}}s
                      </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>