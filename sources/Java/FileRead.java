package com.javaDBS;

import java.io.*;
import java.util.ArrayList;
import java.util.Scanner;

public class FileRead {
    public static ArrayList<Theatre> TheatreRead(){

        ArrayList<Theatre> theatres = new ArrayList<>();

        try{
            File TheatreFile = new File("Y:\\a_UNI\\DBS\\Milestones\\M4\\theatre.csv");
            Scanner sc = new Scanner(TheatreFile);
            sc.useDelimiter(";");

            while(sc.hasNext()){
                Theatre to_add = new Theatre(sc.next().trim(),sc.next(),Integer.parseInt(sc.next()),Integer.parseInt(sc.next().trim()));
                theatres.add(to_add);
            }
            return theatres;

        } catch (FileNotFoundException e) {
            e.printStackTrace();
        }
        return null;
    }
    public static ArrayList<Performance> PerformancesRead(){

        ArrayList<Performance> performances = new ArrayList<>();
        try{

            File PerfFile = new File("Y:\\a_UNI\\DBS\\Milestones\\M4\\perf.csv");
            BufferedReader br = new BufferedReader(new FileReader(PerfFile));
            String delimit = ",";
            String line;
            String[] arr;

            var theatres = TheatreRead();
            int idx = 0;
            while((line = br.readLine()) != null) {
                if(!theatres.isEmpty() && ++idx >= theatres.size())
                    idx = 0;
                arr = line.split(delimit);
                Performance to_add = new Performance(arr[0], theatres.get(idx).t_Name, arr[1],arr[2],arr[3]);
                performances.add(to_add);
            }
            br.close();
            return performances;

        }  catch (IOException e) {
            e.printStackTrace();
        }
        return null;
    }
    public static ArrayList<Audience> AudienceRead(){

        ArrayList<Audience> audiences = new ArrayList<>();

        try{
            File PerfFile = new File("Y:\\a_UNI\\DBS\\Milestones\\M4\\audience.csv");
            BufferedReader bra = new BufferedReader(new FileReader(PerfFile));
            String delimit = ",";
            String line;
            String[] arr;

            while((line = bra.readLine()) != null) {
                arr = line.split(delimit);
                Audience to_add = new Audience(Integer.parseInt(arr[0]),Integer.parseInt(arr[1]),arr[2],arr[3],arr[4]);
                audiences.add(to_add);
            }
            bra.close();
            return audiences;

        }  catch (IOException e) {
            e.printStackTrace();
        }
        return null;
    }
    public static ArrayList<Ticket> TicketRead(){

        ArrayList<Ticket> tickets = new ArrayList<>();

        try{
            File TickFile = new File("Y:\\a_UNI\\DBS\\Milestones\\M4\\ticket.csv");
            BufferedReader brt = new BufferedReader(new FileReader(TickFile));
            String delimit = ",";
            String line;
            String[] arr;

            var perf = PerformancesRead();
            int idx = 0;
            while((line = brt.readLine()) != null) {
                if(!perf.isEmpty() && ++idx >= perf.size())
                    idx = 0;
                arr = line.split(delimit);
                Ticket to_add = new Ticket(Integer.parseInt(arr[0]),arr[1],perf.get(idx).P_NAME);
                tickets.add(to_add);
            }
            brt.close();
            return tickets;

        }  catch (IOException e) {
            e.printStackTrace();
        }
        return null;
    }
    public static ArrayList<Transaction> TransactionRead() {

        ArrayList<Transaction> transactions = new ArrayList<>();

        try {
            File TickFile = new File("Y:\\a_UNI\\DBS\\Milestones\\M4\\transaction.csv");
            BufferedReader brtr = new BufferedReader(new FileReader(TickFile));
            String delimit = ",";
            String line;
            String[] arr;

            var box_offices = BoxRead();
            int idx = 0;
            while ((line = brtr.readLine()) != null) {
                if (!box_offices.isEmpty() && ++idx >= box_offices.size())
                    idx = 0;
                while ((line = brtr.readLine()) != null) {
                    arr = line.split(delimit);
                    Transaction to_add = new Transaction(Integer.parseInt(arr[0]), arr[1], arr[2], Integer.parseInt(arr[3]),box_offices.get(idx).Webshop);
                    transactions.add(to_add);
                }
                brtr.close();
                return transactions;

            }

        } catch (FileNotFoundException e) {
            e.printStackTrace();
        } catch (IOException e) {
            e.printStackTrace();
        }  return null;
    }

    public static ArrayList<Box_office> BoxRead(){

        ArrayList<Box_office> offices = new ArrayList<>();
        try{
            File TickFile = new File("Y:\\a_UNI\\DBS\\Milestones\\M4\\boxoffice.csv");
            BufferedReader brf = new BufferedReader(new FileReader(TickFile));
            String delimit = ",";
            String line;
            String[] arr;

            var theatres = TheatreRead();
            int idx = 0;
            while((line = brf.readLine()) != null) {
                if(!theatres.isEmpty() && ++idx >= theatres.size())
                    idx = 0;
                arr = line.split(delimit);
                Box_office to_add = new Box_office(arr[0], arr[1],arr[2],theatres.get(idx).t_Name,arr[3]);
                offices.add(to_add);
            }
            brf.close();
            return offices;

        }  catch (IOException e) {
            e.printStackTrace();
        }
        return null;

    }

  }


