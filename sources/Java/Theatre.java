package com.javaDBS;

import java.lang.String;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;

public class Theatre {
    String t_Name;
    String Address;
    int t_Capacity;
    int t_private;

    public Theatre(String t_Name, String Address, int t_Capacity, int private_or_public) {
        this.t_Name = t_Name;
        this.Address = Address;
        this.t_Capacity = t_Capacity;
        this.t_private = private_or_public;
    }
    public String insertion(){
        return "INSERT INTO THEATRE VALUES ('" + t_Name + "', '" + Address + "','" + t_Capacity + "','" + t_private + "')";
    }
    public static int statement(Statement stmt) throws SQLException {
        ArrayList<Theatre> theatres = FileRead.TheatreRead();
        int rowsAffected = 0;
        for(Theatre arg : theatres) {
            rowsAffected += stmt.executeUpdate(arg.insertion());
        }
        return rowsAffected;
    }
}

class Box_office{
    String b_name;
    String Webshop;
    String b_Location;
    String Opening_Hours;
    String t_Name;

    public Box_office(String b_name, String webshop, String b_Location, String opening_Hours, String t_Name) {
        this.b_name = b_name;
        this.Webshop = webshop;
        this.b_Location = b_Location;
        this.Opening_Hours = opening_Hours;
        this.t_Name = t_Name;
    }
    public String insertion(){
        return "INSERT INTO box_office VALUES ('" + b_name + "', '" + Webshop + "','" + b_Location + "','" + Opening_Hours + "','" + t_Name + "')";
    }
    public static int statement(Statement stmt) throws SQLException {
        ArrayList<Box_office> offices = FileRead.BoxRead();
        int rowsAffected = 0;
        for(Box_office arg : offices) {
            rowsAffected += stmt.executeUpdate(arg.insertion());
        }
        return rowsAffected;
    }
}