import { Card, CardContent } from "@/Components/ui/card";
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from "@/Components/ui/table";
import { Badge } from "@/Components/ui/badge";
import { useEffect, useState } from "react";
import { getStandings } from "@/Services/api";

export default function LeagueTable() {
    const [standings, setStandings] = useState([]);
    const [loading, setLoading] = useState(false);

    const fetchStandings = async () => {
        setLoading(true);
        try {
            const response = await getStandings();
            setStandings(response.data);
        } catch (error) {
            console.error('Error fetching standings:', error);
        } finally {
            setLoading(false);
        }
    };

    useEffect(() => {
        fetchStandings();
    }, []);

    return (
        <Card className="w-full mx-auto mt-8 shadow-xl bg-white dark:bg-gray-800">
            <CardContent className="p-6">
                <Table>
                    <TableHeader>
                        <TableRow>
                            <TableHead className="w-1/12 text-center">#</TableHead>
                            <TableHead>Team</TableHead>
                            <TableHead className="text-center">MP</TableHead>
                            <TableHead className="text-center">W</TableHead>
                            <TableHead className="text-center">D</TableHead>
                            <TableHead className="text-center">L</TableHead>
                            <TableHead className="text-center">GF</TableHead>
                            <TableHead className="text-center">GA</TableHead>
                            <TableHead className="text-center">GD</TableHead>
                            <TableHead className="text-center">Pts</TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        {
                            loading ?
                                (
                                    <TableRow>
                                        <TableCell colSpan={10} className="text-center">
                                            <Badge variant="default" className="px-2 py-0.5 text-sm">
                                                Loading...
                                            </Badge>
                                        </TableCell>
                                    </TableRow>
                                ) : (
                                    standings.map((team, index) => (
                                        <TableRow key={team.team} className="hover:bg-muted/30 transition">
                                            <TableCell className="text-center font-bold">{index + 1}</TableCell>
                                            <TableCell>
                                                {team.team}
                                            </TableCell>
                                            <TableCell className="text-center">{team.played}</TableCell>
                                            <TableCell className="text-center">{team.won}</TableCell>
                                            <TableCell className="text-center">{team.drawn}</TableCell>
                                            <TableCell className="text-center">{team.lost}</TableCell>
                                            <TableCell className="text-center">{team.gf}</TableCell>
                                            <TableCell className="text-center">{team.ga}</TableCell>
                                            <TableCell className="text-center">{team.gd}</TableCell>
                                            <TableCell className="text-center font-semibold text-primary">
                                                <Badge variant="destructive" className="px-2 py-0.5 text-sm">
                                                    {team.points}
                                                </Badge>
                                            </TableCell>
                                        </TableRow>
                                    ))
                                )
                        }
                    </TableBody>
                </Table>
            </CardContent>
        </Card>
    );
}