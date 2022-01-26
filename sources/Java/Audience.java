package com.javaDBS;

import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;

public class Audience{

    int Customer_ID;
    int AGE;
    String NAME;
    String DISCOUNT;
    String TRANSACTION_ID;

    public Audience(int customer_ID, int AGE, String NAME, String DISCOUNT, String TRANSACTION_ID) {
        Customer_ID = customer_ID;
        this.AGE = AGE;
        this.NAME = NAME;
        this.DISCOUNT = DISCOUNT;
        this.TRANSACTION_ID = TRANSACTION_ID;
    }

    public String insertion(){
        return "INSERT INTO Audience_Member VALUES ('" + Customer_ID + "', '" + AGE + "','" + NAME + "','" + DISCOUNT + "','" + TRANSACTION_ID + "')";
    }
    public static int statement(Statement stmt) throws SQLException {

        ArrayList<Audience> audiences = FileRead.AudienceRead();
        int rowsAffected = 0;
        for(Audience arg : audiences) {
            rowsAffected += stmt.executeUpdate(arg.insertion());
        }
        return rowsAffected;
    }
}