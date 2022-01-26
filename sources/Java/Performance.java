package com.javaDBS;

import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;

public class Performance {

    String P_NAME;
    String t_NAME;
    String P_DATE;
    String DIRECTION;
    String LANGUAGE;

    public Performance(String p_NAME, String t_NAME, String p_DATE, String DIRECTION, String LANGUAGE) {
        this.P_NAME = p_NAME;
        this.t_NAME = t_NAME;
        this.P_DATE = p_DATE;
        this.DIRECTION = DIRECTION;
        this.LANGUAGE = LANGUAGE;
    }
    public String insertion(){
        return "INSERT INTO E_PERFORMANCE VALUES ('" + P_NAME + "', '" +  t_NAME + "', '"  + P_DATE + "','" + DIRECTION + "','" + LANGUAGE + "')";
    }
    public static int statement(Statement stmt) throws SQLException {

        ArrayList<Performance> performances = FileRead.PerformancesRead();
        int rowsAffected = 0;
        for(Performance arg : performances) {
            rowsAffected += stmt.executeUpdate(arg.insertion());
        }
        return rowsAffected;
    }
}

class Ticket{

    int TICKET_ID;
    String SEATING_CATEGORY;
    String P_NAME;

    public Ticket(int i, String SEATING_CATEGORY, String p_NAME) {
        this.TICKET_ID = i;
        this.SEATING_CATEGORY = SEATING_CATEGORY;
        P_NAME = p_NAME;
    }
    public String insertion(){
        return "INSERT INTO TICKET VALUES ('"+ TICKET_ID + "','" + SEATING_CATEGORY + "','" + P_NAME  + "')";
    }
    public static int statement(Statement stmt) throws SQLException {

        ArrayList<Ticket> tickets = FileRead.TicketRead();
        int rowsAffected = 0;
        for(Ticket arg : tickets) {
            rowsAffected += stmt.executeUpdate(arg.insertion());
        }
        return rowsAffected;
    }
}

class Play{

    String genre;
    Performance performance;

}

class Dance{

    Boolean premiere;
    Performance performance;

}