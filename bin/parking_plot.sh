#!/bin/bash

echo "Welcome to Ankit koshti's automated parking lot"
echo "";

show_error()
{
   error=$1;
   echo "ERROR: $error";
   echo;
   exit 1;
}

choose_action()
{
  echo "";
  echo "Choose action";
  echo "1. Create parking lot";
  echo "2. Park vehicle";
  echo "3. Leave vehicle";
  echo "4. Show status";
  echo "5. Search registration number by color";
  echo "6. Search slot number by color";
  echo "7. Search slot number by registration number";
  echo "8. Exit";

  _env=9
  while [ "$_env" -gt 8 ]
  do
    echo -n "Please choose action : "; read _env;
    if [ "$_env" -gt 8 ]
    then
      echo "ERROR: Incorrect input. Try again."
    fi
    DEFAULT_ACTION=$_env;
    case "$_env" in
        1)
            create_parking
            ;;
        2)
            park_vehicle
            ;;
        3)
            free_slot
            ;;
        4)
            show_status
            ;;
        5)
            search_reg_color
            ;;
        6)
            search_slot_color
            ;;
        7)
            search_slot_reg
            ;;
        8)
            exit_session
            ;;
        *)
            show_status
            ;;
    esac
  done
  echo "";
}

create_parking()
{
    _pnum=6
    echo -n "Please enter number of parking lot : "; read _pnum;
    if [ "$_pnum" -lt 1 ]
    then
        echo "Error: Please enter valid number (greater than 0)"
    fi
    php corephp.php create_parking_lot $_pnum;
    echo "";
    choose_action
}

park_vehicle()
{
    _vnumber=""
    _vcolor="White"
    echo -n "Please enter vehicle number : "; read _vnumber;
    if [ $_vnumber == "" ]
    then
        echo "Error: Please enter valid vehicle number"
    fi
    echo -n "Please enter vehicle color : "; read _vcolor;
    if [ $_vcolor == "" ]
    then
        echo "Error: Please enter valid vehicle color"
    fi
    php corephp.php park_vehicle $_vnumber $_vcolor;
    echo "";
    choose_action
}

free_slot()
{
    _slot=1
    echo -n "Please enter slot number : "; read _slot;
    if [ $_slot -lt 1 ]
    then
        echo "Error: Please enter valid slot number"
    fi
    php corephp.php free_slot $_slot;
    echo "";
    choose_action
}

show_status()
{
    php corephp.php show_status;
    echo "";
    choose_action
}

search_reg_color()
{
    _color=""
    echo -n "Please enter color : "; read _color;
    if [ $_color == "" ]
    then
        echo "Error: Please enter valid color"
    fi
    php corephp.php search_reg_color $_color;
    echo "";
    choose_action
}

search_slot_color()
{
    _color=""
    echo -n "Please enter color : "; read _color;
    if [ $_color == "" ]
    then
        echo "Error: Please enter valid color"
    fi
    php corephp.php search_slot_color $_color;
    echo "";
    choose_action
}

search_slot_reg()
{
    _reg=""
    echo -n "Please enter car's registration number : "; read _reg;
    if [ $_reg == "" ]
    then
        echo "Error: Please enter car's valid registration number"
    fi
    php corephp.php search_slot_reg $_reg;
    echo "";
    choose_action
}

exit_session() {
    php corephp.php destroy_session;
    echo "";
    exit 1;
}

#choose action
choose_action

cmd /k