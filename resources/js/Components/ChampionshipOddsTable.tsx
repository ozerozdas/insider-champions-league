import { Card, CardContent } from "@/Components/ui/card";
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from "@/Components/ui/table";
import { Progress } from "@/Components/ui/progress";
import { useEffect, useState } from "react";
import { getChampionshipPredictions } from "@/Services/api";

export default function ChampionshipOddsTable() {
    const [odds, setOdds] = useState([]);
    const [loading, setLoading] = useState(false);

    const fetchOdds = async () => {
        setLoading(true);
        try {
            const response = await getChampionshipPredictions();
            setOdds(response.data);
        } catch (error) {
            console.error('Error fetching standings:', error);
        } finally {
            setLoading(false);
        }
    };

    useEffect(() => {
        fetchOdds();
    }, []);

    return (
        loading ? (
            <p className="w-full text-center">Loading...</p>
        ) : (
            <Card className="w-full mx-auto mt-8 shadow-xl">
                <CardContent className="p-6">
                    <Table>
                        <TableHeader>
                            <TableRow>
                                <TableHead>Team</TableHead>
                                <TableHead className="text-center">Odds (%)</TableHead>
                                <TableHead className="text-center">Visual</TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            {odds.map((team, index) => (
                                <TableRow key={index}>
                                    <TableCell className="font-medium">{team.name}</TableCell>
                                    <TableCell className="text-center">{team.odds}%</TableCell>
                                    <TableCell className="text-center">
                                        <Progress value={team.odds} className="h-2" />
                                    </TableCell>
                                </TableRow>
                            ))}
                        </TableBody>
                    </Table>
                </CardContent>
            </Card>
        )
    );
}
