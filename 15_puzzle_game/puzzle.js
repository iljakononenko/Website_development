var PUZZLE_DIFFICULTY = 4;
const PUZZLE_HOVER_TINT = "#32CD32";
const PUZZLE_CORNER = "#FF0000";

var _stage;
var _canvas;

var PUZZLE_COLUMNS = 4;
var PUZZLE_ROWS = 4;

var _img;
var _pieces;

var _piece_screen_Width;
var _piece_screen_Height;
var _piece_img_Width;
var _piece_img_Height;

var _puzzle_screen_Width;
var _puzzle_screen_Height;

var _puzzle_img_Width;
var _puzzle_img_Height;

var _piece_width_screen_to_img_ratio;
var _piece_height_screen_to_img_ratio;

var _current_Piece;
var _empty_X;
var _empty_Y;

var _img_src;

var _mouse;

function init()
{
    _img = new Image();
    _img.addEventListener('load', onImage);
    _img.src = "img/myszka.jpg";
    _img_src = "img/myszka.jpg";
}

function new_game(_src)
{
    _img_src = _src;
    _canvas.onmousedown = null;
    _canvas.onmousemove = null;
    _img = new Image();
    _img.addEventListener('load', onImage);
    _img.src = _img_src;
}

function new_settings()
{

    _canvas.onmousedown = null;
    _canvas.onmousemove = null;

    PUZZLE_ROWS = document.getElementById("rows").value;
    PUZZLE_COLUMNS = document.getElementById("columns").value;

    _img = new Image();
    _img.addEventListener('load', onImage);
    _img.src = _img_src;
}

function onImage()
{
    
    _piece_screen_Width = Math.floor(window.screen.availWidth / PUZZLE_COLUMNS);
    _piece_screen_Height = Math.floor(window.screen.availHeight / PUZZLE_ROWS);
    console.log(_piece_screen_Height + " " + window.screen.height + " " + window.screen.availHeight);

    _piece_img_Width = Math.floor(_img.width / PUZZLE_COLUMNS);
    _piece_img_Height = Math.floor(_img.height / PUZZLE_ROWS);

    _puzzle_screen_Width = _piece_screen_Width * PUZZLE_COLUMNS;
    _puzzle_screen_Height = window.screen.availHeight;//_piece_screen_Height * PUZZLE_ROWS;

    _puzzle_img_Width = _piece_img_Width * PUZZLE_COLUMNS;
    _puzzle_img_Height = _piece_img_Height * PUZZLE_ROWS;

    _piece_width_screen_to_img_ratio = _piece_screen_Width / _piece_img_Width;
    _piece_height_screen_to_img_ratio = _piece_screen_Height / _piece_img_Height;

    set_Canvas();
    init_Puzzle();

}

function set_Canvas ()
{
    
    _canvas = document.getElementById('canvas');
    _stage = _canvas.getContext('2d');
    _canvas.width = _puzzle_screen_Width;
    _canvas.height = _puzzle_screen_Height;
    _canvas.style.border = "1px solid black";

}

function init_Puzzle ()
{
    
    _pieces = [];
    _mouse = {x:0, y:0};
    _current_Piece = null;
    _stage.drawImage(_img, 0, 0, _puzzle_img_Width, _puzzle_img_Height, 0, 0, _puzzle_screen_Width, _puzzle_screen_Height);
    build_Pieces();

}

function create_Title(msg)
{

    _stage.fillStyle = "#808080";
    _stage.globalAlpha = .4;
    _stage.fillRect(100, _puzzle_Height - 40, _puzzle_Width - 200, 40);
    _stage.fillStyle = "#FFFFFF";
    _stage.globalAlpha = 1;
    _stage.textAlign = "center";
    _stage.textBaseline = "middle";
    _stage.font = "20px Arial";
    _stage.fillText(msg, _puzzle_Width / 2, _puzzle_Height - 20);

}

function build_Pieces ()
{
    var i;
    var piece;
    var xPos = _piece_img_Width;
    var yPos = 0;

    for (i = 1; i < PUZZLE_COLUMNS * PUZZLE_ROWS; i++)
    {

        piece = {};
        piece.sx = xPos;
        piece.sy = yPos;
        _pieces.push(piece);
        xPos += _piece_img_Width;
        if (xPos >= _puzzle_img_Width)
        {
            xPos = 0;
            yPos += _piece_img_Height;
        }
    }

    _canvas.onmousedown = shuffle_Puzzle;

}

function shuffle_Puzzle ()
{

    _pieces = shuffle_Array(_pieces);

    _stage.clearRect(0,0, _puzzle_screen_Width, _puzzle_screen_Height);

    var i;
    var piece;
    var xPos = _piece_screen_Width;
    var yPos = 0;

    _empty_X = 0;
    _empty_Y = 0;
    _stage.fillStyle = "red";
    _stage.fillRect(_empty_X, _empty_Y, _piece_screen_Width, _piece_screen_Height);
    for (i = 0; i < _pieces.length; i++)
    {

        piece = _pieces[i];
        piece.xPos = xPos;
        piece.yPos = yPos;
        console.log(piece.xPos + " " + piece.yPos);
        _stage.drawImage(_img, piece.sx, piece.sy, _piece_img_Width, _piece_img_Height, xPos, yPos, _piece_screen_Width, _piece_screen_Height);
        _stage.strokeRect(xPos, yPos, _piece_screen_Width, _piece_screen_Height);
        xPos += _piece_screen_Width;
        if (xPos >= _puzzle_screen_Width)
        {
            xPos = 0;
            yPos += _piece_screen_Height;
        }
    }

    _canvas.onmousedown = on_Puzzle_Click;
    _canvas.onmousemove = hovering_possible_piece;

}

function on_Puzzle_Click(e)
{
    var temp_X, temp_Y;
    if (e.layerX || e.layerX == 0)
    {
        _mouse.x = e.layerX - _canvas.offsetLeft;
        _mouse.y = e.layerY - _canvas.offsetTop;
    }

    else if (e.offsetX || e.offsetX == 0)
    {
        _mouse.x = e.offsetX - _canvas.offsetLeft;
        _mouse.y = e.offsetY - _canvas.offsetTop;
    }

    _current_Piece = get_Piece();

    if (_current_Piece != null)
    {
        console.log("mouse: " + _mouse.x + " " + _mouse.y + " / piece: " + _current_Piece.xPos + " " + _current_Piece.yPos);
        if (check_if_piece_nearby())
        {
            temp_X = _current_Piece.xPos;
            _current_Piece.xPos = _empty_X;
            _empty_X = temp_X;

            temp_Y = _current_Piece.yPos;
            _current_Piece.yPos = _empty_Y;
            _empty_Y = temp_Y;

        }

        draw_canvas();
        check_if_won();
        
    }

}

function hovering_possible_piece (e)
{
    draw_canvas();

    if (e.layerX || e.layerX == 0)
    {
        _mouse.x = e.layerX - _canvas.offsetLeft;
        _mouse.y = e.layerY - _canvas.offsetTop;
    }

    else if (e.offsetX || e.offsetX == 0)
    {
        _mouse.x = e.offsetX - _canvas.offsetLeft;
        _mouse.y = e.offsetY - _canvas.offsetTop;
    }

    _current_Piece = get_Piece();

    if (check_if_piece_nearby())
    {
        _stage.fillStyle = PUZZLE_HOVER_TINT;
        _stage.fillRect(_current_Piece.xPos, _current_Piece.yPos, _piece_screen_Width, _piece_screen_Height);
    }

}

function check_if_piece_nearby ()
{
    var flag = false;
    if (_current_Piece == null)
    {
        return flag;
    }
    if (Math.abs(_current_Piece.xPos - _empty_X) == _piece_screen_Width && _current_Piece.yPos == _empty_Y)
    {
        flag = true;
    }

    if (Math.abs(_current_Piece.yPos - _empty_Y) == _piece_screen_Height && _current_Piece.xPos == _empty_X)
    {
        flag = true;
    }
    return flag;
}

function draw_canvas ()
{
    _stage.clearRect(0, 0, _piece_screen_Width, _piece_screen_Height);
    var i;
    var piece;
    for(i = 0;i < _pieces.length;i++)
    {

        piece = _pieces[i];
        _stage.drawImage(_img, piece.sx, piece.sy, _piece_img_Width, _piece_img_Height, piece.xPos, piece.yPos, _piece_screen_Width, _piece_screen_Height);
        _stage.strokeRect(piece.xPos, piece.yPos, _piece_screen_Width, _piece_screen_Height);
                    
    }
    _stage.fillStyle = "red";
    _stage.fillRect(_empty_X, _empty_Y, _piece_screen_Width, _piece_screen_Height);
}

function win_fast()
{

    _empty_X = 0;
    _empty_Y = 0;

    var i, piece;
    for (i = 0; i < _pieces.length; i++)
    {

        // xPos = screen width
        // sx = img width

        piece = _pieces[i];
        piece.xPos = piece.sx * _piece_width_screen_to_img_ratio;
        piece.yPos = piece.sy * _piece_height_screen_to_img_ratio;

    }

    draw_canvas();
    check_if_won();

}

function check_if_won ()
{

    var gameWin = true;
    var i, piece;
    for (i = 0; i < _pieces.length; i++)
    {
        piece = _pieces[i];

        // xPos = screen width
        // sx = img width

        if(piece.xPos != piece.sx * _piece_width_screen_to_img_ratio || piece.yPos != piece.sy * _piece_height_screen_to_img_ratio)
        {
            gameWin = false;
        }
    }
    if (gameWin)
    {
        game_Over();
    }

}

function game_Over()
{
    console.log("You are a winner!");
    _canvas.onmousedown = null;
    _canvas.onmousemove = null;
    setTimeout(init_Puzzle, 1500);
}

function get_Piece ()
{
    var i, piece;

    for (i = 0; i < _pieces.length; i++)
    {
        piece = _pieces[i];
        if (_mouse.x < piece.xPos || _mouse.x > (piece.xPos + _piece_screen_Width) || _mouse.y < piece.yPos || _mouse.y > (piece.yPos + _piece_screen_Height))
        {
            continue;
        }
        else
        {
            return piece;
        }
    }

    return null;
}

function shuffle_Array(array)
{

    var j, x, i = array.length;

    while(i > 0)
    {

        j = parseInt(Math.random() * i)
        x = array[--i];
        array[i] = array[j];
        array[j] = x;

    }        

    return array;
}


